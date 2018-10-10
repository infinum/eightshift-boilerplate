const wpInstaller = require('./wp-installer');
const files = require('./files');

const run = async() => {
  const manifest = files.readManifestFull();

  wpInstaller.intro(manifest.url);
  wpInstaller.selectEnv();
};
run();
