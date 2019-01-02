// require modules
var fs = require('fs');
const path = require('path');
var archiver = require('archiver');

const folders = [
  'admin',
  'bin',
  'helpers',
  'includes',
  'languages',
  'page-templates',
  'skin',
  'template-parts',
  'theme',
];

// Get theme folder name
const themeName = path.basename(path.join(__dirname, '..'));
 
// Create a file to stream archive data to.
const archivePath = path.join(__dirname, '..', `${themeName}.zip`);

var output = fs.createWriteStream(archivePath);
var archive = archiver('zip', {
  zlib: { level: 9 } // Sets the compression level.
});

// pipe archive data to the file
archive.pipe(output);
 
// listen for all archive data to be written
// 'close' event is fired only when a file descriptor is involved
output.on('close', function() {
  console.log('');
  console.log('Archive created at:');
  console.log(archivePath);
  console.log('');
});
 
// This event is fired when the data source is drained no matter what was the data source.
// It is not part of this library but rather from the NodeJS Stream API.
// @see: https://nodejs.org/api/stream.html#stream_event_end
output.on('end', function() {
  console.log('Data has been drained');
});
 
// good practice to catch warnings (ie stat failures and other non-blocking errors)
archive.on('warning', function(err) {
  if (err.code === 'ENOENT') {
    // log warning
  } else {
    // throw error
    throw err;
  }
});
 
// good practice to catch this error explicitly
archive.on('error', function(err) {
  throw err;
});

// Append all files
archive.glob('*');
 
// append files from a sub-directory, putting its contents at the root of archive
for (let folder of folders) {
  archive.directory(folder, folder);
}

// finalize the archive (ie we are done appending files but streams have to finish yet)
// 'close', 'end' or 'finish' may be fired right after calling this method so register to them beforehand
archive.finalize();
