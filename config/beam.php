<?php

return [
    /**
     * --------------------------------------------------------------------------
     * API Key
     * --------------------------------------------------------------------------
     * This key can be found in the Beam dashboard, within your User settings.
     * Your API key is used to authenticate your requests to the Beam API,
     * so make sure to keep it secret.
     */
    'api_key' => env('BEAM_API_KEY'),

    /**
     * --------------------------------------------------------------------------
     * Project ID
     * --------------------------------------------------------------------------
     * This ID can be found in the Beam dashboard, within your Project settings.
     * Your project ID is used to identify which project you want to beam data to.
     */
    'project_id' => env('BEAM_PROJECT_ID'),
];
