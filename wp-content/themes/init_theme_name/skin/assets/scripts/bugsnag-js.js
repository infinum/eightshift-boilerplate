/* global process */
import bugsnag from 'bugsnag-js';

bugsnag.apiKey = '';
bugsnag.notifyReleaseStages = ['production', 'staging'];
bugsnag.releaseStage = process.env.NODE_ENV;
