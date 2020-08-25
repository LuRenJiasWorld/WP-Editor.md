export const SM_MS_API = (api: string) => "https://sm.ms/api/v2/" + api;

export const SM_MS_HEADER = (token: string) => ["Authorization: " + token];

export const ACTION_THROTTLE_TIME_MS = 500;