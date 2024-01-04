module.exports = {
    productionSourceMap: process.env.NODE_ENV !== 'production',
    lintOnSave: false,
    runtimeCompiler: true,
    configureWebpack: {
        //Necessary to run npm link https://webpack.js.org/configuration/resolve/#resolve-symlinks
        resolve: {
            symlinks: false
        }
    },
    transpileDependencies: [
        '@coreui/utils'
    ],
    devServer: {
        proxy: 'http://localhost:8000/'
    },
    outputDir: '../../public/assets/app',

    publicPath: process.env.NODE_ENV === 'production'
        ? '/assets/app/'
        : '/',

    // modify the location of the generated HTML file.
    indexPath: process.env.NODE_ENV === 'production'
        ? '../../../resources/views/app.blade.php'
        : 'index.html'
}
