var Encore = require("@symfony/webpack-encore");

Encore
// directory where all compiled assets will be stored
    .setOutputPath("var/webpack/")
    // what's the public path to this directory (relative to your project's document root dir)
    .setPublicPath("/build")
    .setManifestKeyPrefix('build')
    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()
    // enable react in babel
    .enableReactPreset()
    // so we don't need to deal with runtime.js
    .disableSingleRuntimeChunk()
    // will output as app/Resources/webpack/server-bundle.js
    .addEntry("server-bundle", "./assets/js/entryPoint.js")
    .addEntry("buddy", "./assets/js/buddy.js")
    .copyFiles({
        from: './assets/images',
        to: 'images/[path][name].[hash:8].[ext]'
    })
;

// export the final configuration
var config = Encore.getWebpackConfig();
config.output.globalObject = "this";
module.exports = config;
