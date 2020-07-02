var Mock = require("mockjs");

const MOCK_AUTH_HEADER = "Authorization: 00000000000000000000000000000000";

module.exports = function() {
  console.log("Mocking service enabled");

  Mock.mock(/test_endpoint/, function(options) {
    const { body } = options;

    const bodyObject = JSON.parse(body);
    const proxy_url = bodyObject["url"];
    const proxy_type = bodyObject["method"];
    const proxy_header = bodyObject["header"];

    switch (proxy_url) {
      case "https://sm.ms/api/v2/profile":
        if (proxy_type === "post" && proxy_header[0] === MOCK_AUTH_HEADER) {
          return {
            success: true,
            code: "success",
            message: "Get user profile success.",
            data: {
              username: "LuRenJia",
              email: "loli@lurenjia.in",
              role: "user",
              group_expire: "0000-00-00",
              email_verified: 0,
              disk_usage: "0.00 ",
              disk_limit: "5.00 GB",
              disk_usage_raw: 0,
              disk_limit_raw: 5368709120,
            },
            RequestId: "E7299EC0-1510-4997-8461-D694F5ADBB25",
          };
        }
        break;
      case "https://sm.ms/api/v2/upload_history":
        if (proxy_type == "get" && proxy_header[0] === MOCK_AUTH_HEADER) {
          return {
            success: true,
            code: "success",
            message: "Get list success.",
            data: [
              {
                width: 800,
                height: 1132,
                filename: "af0d89dd-67ee-4032-aee8-77619907949c2.gif",
                storename: "MVS7BqwImvxLXuk.jpg",
                size: 30335,
                path: "/2020/06/26/MVS7BqwImvxLXuk.jpg",
                hash: "MfDnBpar4qgcHhY9lXiFIo7y5C",
                created_at: 1593180021,
                url: "https://i.loli.net/2020/06/26/MVS7BqwImvxLXuk.jpg",
                delete: "https://sm.ms/delete/MfDnBpar4qgcHhY9lXiFIo7y5C",
                page: "https://sm.ms/image/MVS7BqwImvxLXuk",
              },
            ],
            RequestId: "6178D268-985E-4CE1-B5C7-D7B85EA66B54",
          };
        }
        break;
    }
  });
};
