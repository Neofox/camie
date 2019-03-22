var Encore = require("@symfony/webpack-encore");

Encore
// directory where all compiled assets will be stored
    .setOutputPath("public/build/")
    // what's the public path to this directory (relative to your project's document root dir)
    .setPublicPath("/build")
    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()
    // enable react in babel
    .enableReactPreset()
    // Since Encore 4
    .enableSingleRuntimeChunk()
    // create hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())
    .enableSourceMaps(!Encore.isProduction())
    // will output as web/build/app.js
    .addEntry("app", "./assets/js/clientSideEntryPoint.js")
;

// export the final configuration
module.exports = Encore.getWebpackConfig();
