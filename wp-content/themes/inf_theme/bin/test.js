const path = require('path');

// const stylePath = path.join(__dirname, '..', 'style.css');

// console.log(stylePath);

// Get theme name
const themeName = path.basename(path.join(__dirname, '..'));
 
// create a file to stream archive data to.
const archivePath = path.join(__dirname, '..', `${themeName}.zip`);


console.log("Theme name: ", themeName);
console.log("Path: ", archivePath);
