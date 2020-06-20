var Mock = require("mockjs");

module.exports = function() {
  console.log("Mocking service enabled");

  Mock.mock(/test_endpoint/, function(options) {
    const { url, type, body } = options;

    const bodyObject = JSON.parse(body);
    const proxy_url = bodyObject["url"];
    const proxy_type = bodyObject["method"];
    const proxy_header = bodyObject["header"];

    switch (proxy_url) {
    case "https://sm.ms/api/v2/profile":
      if (proxy_type === "post" && proxy_header[0] === "Authorization: 00000000000000000000000000000000") {
        return {
          "success": true,
          "code": "success",
          "message": "Get user profile success.",
          "data": {
            "username": "LuRenJia",
            "email": "loli@lurenjia.in",
            "role": "user",
            "group_expire": "0000-00-00",
            "email_verified": 0,
            "disk_usage": "0.00 ",
            "disk_limit": "5.00 GB",
            "disk_usage_raw": 0,
            "disk_limit_raw": 5368709120
          },
          "RequestId": "E7299EC0-1510-4997-8461-D694F5ADBB25"
        };
      }
    }
  });
};