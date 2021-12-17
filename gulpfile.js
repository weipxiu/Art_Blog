const fs = require('fs');
const gulp = require('gulp');
const del = require('del') // //清空目录下资源
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
    console.log('\n' + data[4].replace(/Version:/g, '') + '\n')
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
gulp.task("del", async () => {
    console.log('\n已成功清理' + target + '文件目录！！！！！！\n')
    await del([target + '/*', "./Art_Blog.zip"], { force: true, dryRun: true }); //force:强力删除，dryRun：允许删除当前工作目录和外部目录
})

// 拷贝文件
gulp.task("copyHtml", async () => {
    //pipe后面对应的地址就是将前面路径文件拷贝复制到哪里去
    console.log('\n正在打包编译中，请稍后......................\n');
    await gulp.src(["src/**", "!src/*.html", "!src/js/*", "!src/css/*"]).pipe(gulp.dest(target))
});

//压缩html
gulp.task('miniHtml', async () => {
    await gulp.src(['src/*.html'])
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
gulp.task("minCss", async () => {
    await gulp.src(["src/css/codecolorer.css", "src/css/swiper.min.css", "src/css/login.css"])
        /*.pipe(rev())//添加hash值防缓存
        .pipe(gulpless())
        .pipe(gulp_minify_css({
           advanced: false,//类型：Boolean 默认：true [是否开启高级优化（合并选择器等）]
           compatibility: '*'//保留ie7及以下兼容写法 类型：String 默认：''or'*' [启用兼容模式； 'ie7'：IE7兼容模式，'ie8'：IE8兼容模式，'*'：IE9+兼容模式]
        }))*/
        .pipe(gulp.dest(target + "/css"))
});

// 多端压缩合并css
gulp.task("mergeCss", async () => {
    await gulp.src(["src/css/main.css", "src/css/style-pc.css", "src/css/style-ios.css", "src/css/style-ipd.css", "src/css/video-js.css"])
        .pipe(concat("style_min.css"))
        .pipe(gulp_minify_css({
            advanced: false,
            compatibility: '*'
        }))
        .pipe(gulp.dest(target + "/css"))
});

//图片压缩
//安装模块 npm install --save-dev gulp-imagemin
gulp.task("imageMin", async () => {
    await gulp.src('src/images/*')
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
gulp.task("jsCopy", async () => {
    //特例
    await gulp.src(["src/js/jquery-2.1.4.min.js", "src/js/swiper.min.js"])
        .pipe(gulp.dest(target + "/js"))
})

//ES6转换转ES5(babel-v8版本)、代码合并
//安装 npm i gulp-concat --save-dev
gulp.task("jsConcat", async () => {
    //公共
    await gulp.src(["src/js/main.js", "src/js/ajax_wordpress.js"])
        .pipe(plumber())
        .pipe(babel({
            presets: ['@babel/preset-env']
        }))
        .pipe(concat("main_min.js"))
        .pipe(scriptmin()) //在合并的时候压缩js
        .pipe(gulp.dest(target + "/js"))
})

//打包zip
gulp.task('compressZip', async () => {
    //,{ base: '.', follow: true }压缩当前dist文件夹
    await gulp.src(['./dist/**'])
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
gulp.task("Watch", function (done) {
    gulp.watch(["./src/css/codecolorer.css", "./src/css/swiper.min.css", "./src/css/login.css"], gulp.series('minCss'));
    gulp.watch(["src/css/main.css", "src/css/style-pc.css", "src/css/style-ios.css", "src/css/style-ipd.css", "src/css/video-js.css"], gulp.series('mergeCss'));
    gulp.watch(["./src/**/**.js"], gulp.series('jsConcat'));
    gulp.watch(["./src/**", "!src/*.html", "!/src/js/*", "!/src/**.css"], gulp.series('copyHtml'));
    done()
})

//如果直接执行 gulp 那么就是运行任务名称为‘default’的任务,后面数组代表所需要执行的任务列表
//"imageMin"不加入，否则打包太慢，图片压缩还是单独处理比较好
gulp.task('default', gulp.series('del', gulp.parallel('copyHtml', 'miniHtml', 'minCss', 'mergeCss', 'jsCopy', 'jsConcat', 'compressZip', 'Watch')
    , function (done) {
        console.log('\n恭喜您，打包成功，文件目录' + target + '\n');
        done(); //done回调函数的作用是在task完成时通知Gulp（而不是返回一个流），而task里的所有其他功能都纯粹依赖Node来实现
    }));
