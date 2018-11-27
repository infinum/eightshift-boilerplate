const replace = require('replace-in-file');

replaceThemeData = async (themeData) => {
  
  // Name
  if (themeData.name) {
    await replace({
      files: 'functions.php',
      from: /^ * Theme Name: .*$/m,
      to: ` * Theme Name: '${themeData.name}';`,
    });
    await replace({
      files: 'style.css',
      from: /^Theme Name: .*$/m,
      to: `Theme Name: '${themeData.name}';`,
    });
  }

  // Description
  // Author
  // Package
  // Namespace
  // env
  // assetManifest
  // devUrl
  // email
}

run = async() => {

  // -----------------------------
  //  1. Replace theme info
  // ----------------------------- 

  const spinnerReplace = ora('1. Replacing theme info').start();
  await replaceThemeData().then(() => {
    spinnerReplace.succeed();
  }).catch((error) => {
    spinnerReplace.fail(`${spinnerReplace.text}\n${error}`);
    process.exit();
  });

}
run();