import 'babel-polyfill';
import 'whatwg-fetch';
import bugsnag from 'bugsnag-js';

bugsnag.apiKey = '';
bugsnag.notifyReleaseStages = ['production', 'staging'];
bugsnag.releaseStage = process.env.NODE_ENV;

import './fonts';

import './form-fields/checkbox';
import './form-fields/radio';

import './cookies-notification';
import './scroll-to';
