const gulp = require('gulp');
const clean = require('gulp-clean');//清空目录下资源
const htmlmin = require('gulp-htmlmin');//压缩html
const imagemin = require('gulp-imagemin'); //引入图片压缩模块
const scriptmin = require('gulp-uglify'); //引入js压缩模块
const gulpless = require('gulp-less'); //引入less转换模块
const gulp_minify_css = require('gulp-minify-css'); //压缩css
const concat = require('gulp-concat'); //引入合并代码模块
const babel = require('gulp-babel'); //引入ES6转ES5模块
const rev = require('gulp-rev');//给静态文件资源添加hash值防缓存
const preprocess = require("gulp-preprocess"); //区分html,js环境变量
const runSequence = require('run-sequence'); //流程控制，控制任务执行顺序
const plumber = require('gulp-plumber'); //阻止报错暂停

const browserSync = require('browser-sync'); //热更新模块

// 环境变量
const env = process.env.NODE_ENV

let target = env === 'production' ? './dist' : 'D:/PHPTutorial/WWW/wp-content/themes/Art_Blog'
console.log('当前环境：'+env+'对应打包地址：'+target)

/*
gulp.task -- 定义任务
gulp.src -- 找到需要执行任务的文件
gulp.dest -- 执行任务的文件的去处
gulp.watch -- 观察文件是否发生改变
安装gulpless压缩模块 npm i gulp-less --save-dev

执行任务 gulp + 任务名称 + 回车
*/

//清空dist目录
var clear = function(href){
    gulp.task("clean", function () {
       console.log('清空'+(href || target)+'目录下的资源')
       return gulp.src((href || target+'/*'), {
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
    return gulp.src(["src/**", "!src/*.html", "!src/*.css", "!src/js/*", "!src/css/*"]).pipe(gulp.dest(target))
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
    gulp.src("src/css/*.css")
        //.pipe(rev())//添加hash值防缓存
        //.pipe(gulpless())
        .pipe(gulp_minify_css())
        .pipe(gulp.dest(target+"/css"))

    //style.css压缩
    return gulp.src("src/style.css")
    .pipe(gulp_minify_css())    
    .pipe(gulp.dest(target))
});

//压缩完的style.css追加版本号
gulp.task("themesVer", function () {
    return gulp.src(["src/ver.css",target+"/style.css"])
    .pipe(concat("style.css"))
    .pipe(gulp.dest(target))
})

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
                    }
                ]
            })
        ]))
        .pipe(gulp.dest(target+'/images'))
})

// ES6转换转ES5(babel-v8版本)
// gulp.task('babel', () =>{
//       return  gulp.src('src/js/*.js')
//         .pipe(babel({
//             presets: ['@babel/preset-env']
//         }))
//         .pipe(scriptmin()) //转换后进行压缩
//         .pipe(gulp.dest(target+'/js'))
//     }
// );


//ES6转换转ES5(babel-v8版本)、代码合并
//安装 npm i gulp-concat --save-dev
gulp.task("jsConcat", function () {
    //公共
     gulp.src(["src/js/main.js","src/js/ajax_wordpress.js"])
        .pipe(plumber())
        .pipe(babel({
            presets: ['@babel/preset-env']
        }))
        .pipe(concat("main_min.js"))
        .pipe(scriptmin()) //在合并的时候压缩js
        .pipe(gulp.dest(target+"/js"))
    
    //特例
    gulp.src(["src/js/rem.js","src/js/date.js","src/js/jquery-2.1.4.min.js","src/js/jquery.lazyload.js"])
        .pipe(gulp.dest(target+"/js"))
    
    //首页
    return gulp.src(["src/js/index.js","src/js/swiper.min.js"])
        .pipe(babel({
            presets: ['@babel/preset-env']
        }))
        .pipe(scriptmin()) //转换后进行压缩
        .pipe(concat("index_min.js"))
        .pipe(scriptmin()) //在合并的时候压缩js
        .pipe(gulp.dest(target+"/js"))
})

//初始化browserSync
// browserSync.init({
//     server: {
//         baseDir: './src'
//     },
//     prot:1234,
//     middleware: function (req, res, next) {
//         let str = '';
//         let pathname = require('url').parse(req.url).pathname;
//         if (pathname.match(/\.css/)) {
//             str = scssSolve(pathname);
//             if (str) {
//                 res.end(str);
//             }
//         }
//         if (pathname.match(/\.js/)) {
//             str = jsSolve(pathname);
//             if (str) {
//                 res.end(str);
//             }
//         }
//         next();
//     }
// });


//监听文件是否发生改变
gulp.task("Watch", function () {
    gulp.watch(["src/**", "!src/*.html", "!src/js/*", "!src/**.css"], ["copyHtml"]);
    gulp.watch(['src/*.html'], ["miniHtml"]);
    gulp.watch(["src/**.css"], ["minCss"]);
    gulp.watch([target+"/**.css"], ["themesVer"]);
    gulp.watch(["src/*.js"], ["jsConcat"]);
})


//如果直接执行 gulp 那么就是运行任务名称为‘default’的任务,后面数组代表所需要执行的任务列表
//"imageMin"不加入，否则打包太慢，图片压缩还是单独处理比较好
gulp.task('default',function(){
    runSequence("clean", "copyHtml", "miniHtml", "minCss", "themesVer", "jsConcat", "Watch",function(){
        console.log('\n恭喜你，编译打包已完成，所有文件在'+target+'文件夹！！！');
    })
});