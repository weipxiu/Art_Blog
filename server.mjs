import express from 'express';
import chalk from 'chalk';
import { createProxyMiddleware } from 'http-proxy-middleware';
import { internalIpV4 } from 'internal-ip';
import path from 'path'; // node自带（更多参考https://www.runoob.com/nodejs/nodejs-path-module.html）
import { fileURLToPath } from 'url'; // node自带
import connectLivereload from 'connect-livereload';
import livereload from 'livereload';

const __filename = fileURLToPath(import.meta.url); // fileURLToPath函数将文件URL(import.meta.url)解码为路径字符串，并确保在将给定的文件URL转换为路径时正确地附加/调整了URL控制字符(/，％)

const __dirname = path.dirname(__filename); // 根据__filename文件的地址返回该文件夹地址"/Users/lijun/Documents/个人项目/Art_Blog"

const app = express()
const PORT = process.env.PORT || '3000'
const staticDir = path.resolve(__dirname, process.env.STATIC_DIR || 'src'); // 路径拼接
// app.use('/', express.static('static')) //设置静态资源路径
app.use(connectLivereload());
app.use(express.static(staticDir));

app.use(
    '/api',
    createProxyMiddleware({
        target: 'https://www.weipxiu.com/', //代理域名或ip
        changeOrigin: true,
        logLevel: 'debug', // node终端可以查看转发过程
        pathRewrite: {
            '^/api': '',
        },
    })
)

app.listen(PORT, async () => {
  console.log();
  console.log(chalk.yellowBright(`server is listening at ${PORT}`));
  console.log();
  const ip = await internalIpV4();
  console.log(chalk.green(`🌏 http://localhost:${PORT}`));
  console.log(chalk.green(`🌏 http://127.0.0.1:${PORT}`));
  console.log(chalk.green(`🌏 http://${ip}:${PORT}`));
});

const liveReloadServer = livereload.createServer();
liveReloadServer.watch(staticDir);
liveReloadServer.server.once('connection', () => {
  setTimeout(() => {
    liveReloadServer.refresh('/');
  }, 100);
});
