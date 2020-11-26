const fs = require('fs');
const gulp = require('gulp');
const clean = require('gulp-clean');//清空目录下资源
const htmlmin = require('gulp-htmlmin');//压缩html
//const imagemin = require('gulp-imagemin'); //引入图片压缩模块
const scriptmin = require('gulp-uglify'); //引入js压缩模块
//const gulpless = require('gulp-less'); //引入less转换模块
const gulp_minify_css = require('gulp-minify-css'); //压缩css
const concat = require('gulp-concat'); //引入合并代码模块
const babel = require('gulp-babel'); //引入ES6转ES5模块
//const rev = require('gulp-rev');//给静态文件资源添加hash值防缓存
const zip = require('gulp-zip');;//打包后压缩zip
const preprocess = require("gulp-preprocess"); //区分html,js环境变量
const runSequence = require('run-sequence'); //流程控制，控制任务执行顺序
const plumber = require('gulp-plumber'); //阻止报错暂停
//const browserSync = require('browser-sync').create(); //热更新模块

// 环境变量
const env = process.env.NODE_ENV === 'production' ? true : false

let target = env ? './dist/Art_Blog' : 'D:/PHPTutorial/WWW/wp-content/themes/Art_Blog'
console.log('当前环境：' + env + '对应打包地址：' + target)

// 对Date的扩展，将 Date 转化为指定格式的String
// 月(M)、日(d)、小时(h)、分(m)、秒(s)、季度(q) 可以用 1-2 个占位符，
// 年(y)可以用 1-4 个占位符，毫秒(S)只能用 1 个占位符(是 1-3 位的数字)
// 例子：
// (new Date()).Format("yyyy-MM-dd hh:mm:ss.S") ==> 2006-07-02 08:09:04.423
// (new Date()).Format("yyyy-M-d h:m:s.S") ==> 2006-7-2 8:9:4.18

Date.prototype.Format = function (fmt) { // author: meizz
    var o = {
        "M+": this.getMonth() + 1, // 月份
        "d+": this.getDate(), // 日
        "h+": this.getHours(), // 小时
        "m+": this.getMinutes(), // 分
        "s+": this.getSeconds(), // 秒
        "q+": Math.floor((this.getMonth() + 3) / 3), // 季度
        "S": this.getMilliseconds() // 毫秒
    };
    if (/(y+)/.test(fmt))
        fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
        if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}

//每次打包往首页追加打包时间信息
function writeFileToLine(ver, url) {
    let data = fs.readFileSync(url, 'utf8').split(/\r\n|\n|\r/gm); //readFileSync的第一个参数是文件名
    let _ver = ver || data[4].replace(/Version:/g, '');
    console.log(data[4].replace(/Version:/g, ''))
    data[4] = `<meta name='generator' content='WordPress/Art_Blog v${new Date().Format("yyyy-MM-dd hh:mm:ss")}'>`;
    fs.writeFileSync(url, data.join('\n'))
}
writeFileToLine('', './src/index.php')

/*
gulp.task -- 定义任务
gulp.src -- 找到需要执行任务的文件
gulp.dest -- 执行任务的文件的去处
gulp.watch -- 观察文件是否发生改变
安装gulpless压缩模块 npm i gulp-less --save-dev
执行任务 gulp + 任务名称 + 回车
*/

//清空dist目录
var clear = function (href) {
    gulp.task("clean", function () {
        console.log('清空' + (href || target) + '目录下的资源')
        return gulp.src([href || target + '/*', "Art_Blog.zip"], {
            read: false //设置参数read:false可以阻止访问文件,加快删除速度
        })
            .pipe(clean({
                force: true
            }));
    })
}
clear()

// 拷贝文件
gulp.task("copyHtml", function () {
    //pipe后面对应的地址就是将前面路径文件拷贝复制到哪里去
    console.log('\n正在打包编译中，请稍后......................\n');
    return gulp.src(["src/**", "!src/*.html", "!src/js/*", "!src/css/*"]).pipe(gulp.dest(target))
});

//压缩html
gulp.task('miniHtml', () => {
    return gulp.src(['src/*.html'])
        .pipe(preprocess({
            context: {
                // 此处可接受来自调用命令的 NODE_ENV 参数，默认为 development 开发测试环境
                NODE_ENV: process.env.NODE_ENV || 'development',
            },
        }))
        .pipe(htmlmin({
            collapseWhitespace: false, // 折叠html节点间的空白
            minifyCSS: true, // 压缩css
            minifyJS: true, // 压缩js
            removeComments: true, // 去除注释
            removeEmptyAttributes: true, // 去除空属性
            removeRedundantAttributes: true // 去除与默认属性一致的属性值
        }))
        .pipe(gulp.dest(target));
});

// 压缩css
gulp.task("minCss", function () {
    return gulp.src(["src/css/codecolorer.css", "src/css/swiper.min.css", "src/css/login.css","src/css/share.css"])
        //.pipe(rev())//添加hash值防缓存
        //.pipe(gulpless())
        //.pipe(gulp_minify_css({
        //    advanced: false,//类型：Boolean 默认：true [是否开启高级优化（合并选择器等）]
        //    compatibility: '*'//保留ie7及以下兼容写法 类型：String 默认：''or'*' [启用兼容模式； 'ie7'：IE7兼容模式，'ie8'：IE8兼容模式，'*'：IE9+兼容模式]
        //}))
        .pipe(gulp.dest(target + "/css"))
});

// 多端压缩合并css
gulp.task("mergeCss", function () {
    return gulp.src(["src/css/main.css", "src/css/style-pc.css", "src/css/style-ios.css", "src/css/style-ipd.css", "src/css/video-js.css"])
        .pipe(concat("style_min.css"))
        .pipe(gulp_minify_css({
            advanced: false,
            compatibility: '*'
        }))
        .pipe(gulp.dest(target + "/css"))
});

//图片压缩
//安装模块 npm install --save-dev gulp-imagemin
gulp.task("imageMin", function () {
    return gulp.src('src/images/*')
        .pipe(imagemin([
            imagemin.gifsicle({
                interlaced: true
            }),
            imagemin.jpegtran({
                progressive: true
            }),
            imagemin.optipng({
                optimizationLevel: 7
            }),
            imagemin.svgo({
                plugins: [{
                    removeViewBox: true
                },
                {
                    cleanupIDs: false
                }]
            })
        ]))
        .pipe(gulp.dest(target + '/images'))
})

// js插件copy
gulp.task("jsCopy", function () {
    //特例
    return gulp.src(["src/js/jquery-2.1.4.min.js", "src/js/swiper.min.js", "src/js/jquery.lazyload.js"])
        .pipe(gulp.dest(target + "/js"))
})

//ES6转换转ES5(babel-v8版本)、代码合并
//安装 npm i gulp-concat --save-dev
gulp.task("jsConcat", function () {
    //公共
    return gulp.src(["src/js/main.js", "src/js/ajax_wordpress.js"])
        .pipe(plumber())
        .pipe(babel({
            presets: ['@babel/preset-env']
        }))
        .pipe(concat("main_min.js"))
        .pipe(scriptmin()) //在合并的时候压缩js
        .pipe(gulp.dest(target + "/js"))
})

//打包zip
gulp.task('compressZip', function () {
    //,{ base: '.', follow: true }压缩当前dist文件夹
    return gulp.src(['./dist/**'])
        .pipe(zip('Art_Blog.zip'))
        .pipe(gulp.dest('./'));
});

//初始化browserSync
/* gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: "http://127.0.0.1/",
        port: 3000
    });
});*/

//监听文件是否发生改变
gulp.task("Watch", function () {
    gulp.watch(["src/css/codecolorer.css", "src/css/swiper.min.css", "src/css/login.css"], ['minCss']);
    gulp.watch(["src/css/main.css", "src/css/style-pc.css", "src/css/style-ios.css", "src/css/style-ipd.css", "src/css/video-js.css"], ['mergeCss']);
    gulp.watch(['./src/**/**.js'], ['jsConcat']);
    gulp.watch(["./src/**", "!src/*.html", "!/src/js/*", "!/src/**.css"], ["copyHtml"]);
})

//如果直接执行 gulp 那么就是运行任务名称为‘default’的任务,后面数组代表所需要执行的任务列表
//"imageMin"不加入，否则打包太慢，图片压缩还是单独处理比较好
gulp.task('default', function () {
    runSequence(
        ["clean"],
        ["copyHtml"],
        ["miniHtml",],
        ["minCss"],
        ["mergeCss"],
        ["jsCopy"],
        ["jsConcat"],
        ["compressZip"],
        ["Watch"],
        function () {
            console.log('\n恭喜您，编译打包已完成，打包好文件存放在' + target + '文件夹！！！');
        })
});