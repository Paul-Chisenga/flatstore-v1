<?php

use Illuminate\Support\Facades\Schedule;

// Clear expired password reset tokens
Schedule::command('auth:clear-resets')->daily();
