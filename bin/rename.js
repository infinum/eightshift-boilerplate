const output = require('./output');
const emoji = require('node-emoji');
const ora = require('ora');

const capCase = (string) => string.replace(/\W+/g, '_').split('_').map((item) => item[0].toUpperCase() + item.slice(1)).join('_');

exports.promptThemeData = () => {
  let confirmed = 'n';
  const newManifest = {};
  
  // -----------------------------
  //  Prompt for project info
  // -----------------------------
  
  do {
    newManifest.name = output.prompt({
      label: '1. Please enter your theme name (shown in WordPress admin)*:',
      prompt: `${emoji.get('green_book')} Theme name: `,
      error: 'Theme name field is required and cannot be empty.',
      required: true,
    }).trim();

    newManifest.package = output.prompt({
      label: '2. Please enter your package name (used in translations - ' +
      'lowercase, no special characters, \'_\' or \'-\' allowed for spaces)*:',
      prompt: `${emoji.get('package')} Package name: `,
      error: 'Package name field is required and cannot be empty.',
      required: true,
    }).replace(/\W+/g, '-').toLowerCase().trim();

    newManifest.prefix = output.prompt({
      label: '3. Please enter a theme prefix (used when defining constants - ' +
      'uppercase, no spaces, no special characters)*:',
      prompt: `${emoji.get('bullettrain_front')} Prefix (e.g. INF, ABRR): `,
      error: 'Prefix is required and cannot be empty.',
      required: true,
    }).toUpperCase().trim();

    newManifest.env = `${newManifest.prefix}_ENV`;
    newManifest.assetManifest = `${newManifest.prefix}_ASSETS_MANIFEST`;

    // Namespace
    newManifest.namespace = capCase(newManifest.package);

    // Dev url
    newManifest.url = output.prompt({
      label: '4. Please enter a theme development url (for local development with browsersync -  ' +
      'no protocol)*:',
      prompt: `${emoji.get('earth_africa')} Dev url (e.g. dev.wordpress.com): `,
      error: 'Dev url is required and cannot be empty.',
      required: true,
    }).trim();

    // Theme description
    newManifest.description = output.prompt({
      label: '5. Please enter your theme description:',
      prompt: `${emoji.get('spiral_note_pad')}  Theme description: `,
      required: false,
    }).trim();

    // Author name
    newManifest.author = output.prompt({
      label: '6. Please enter author name:',
      prompt: `${emoji.get('crab')} Author name: `,
      required: false,
    }).trim();

    // Author email
    newManifest.email = output.prompt({
      label: '7. Please enter author email:',
      prompt: `${emoji.get('email')}  Author email: `,
      required: false,
    }).trim();

    confirmed = output.summary([
      {label: `${emoji.get('green_book')} Theme name`, variable: newManifest.name},
      {label: `${emoji.get('spiral_note_pad')}  Theme description`, variable: newManifest.description},
      {label: `${emoji.get('crab')} Author`, variable: `${newManifest.author} <${newManifest.email}>`},
      {label: `${emoji.get('package')} Package`, variable: newManifest.package},
      {label: `${emoji.get('sun_behind_cloud')}  Namespace`, variable: newManifest.namespace},
      {label: `${emoji.get('bullettrain_front')} Theme prefix`, variable: newManifest.prefix},
      {label: `${emoji.get('earth_africa')} Dev url`, variable: newManifest.url},
    ]);
  } while (confirmed !== 'y');

  return newManifest;
};
