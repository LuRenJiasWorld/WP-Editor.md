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
      case "https://smms.app/api/v2/profile":
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
      case "https://smms.app/api/v2/upload_history":
        if (proxy_type === "get" && proxy_header[0] === MOCK_AUTH_HEADER) {
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
                delete: "https://smms.app/delete/MfDnBpar4qgcHhY9lXiFIo7y5C",
                page: "https://smms.app/image/MVS7BqwImvxLXuk",
              },
              {
                width: 2208,
                height: 1379,
                filename: "星空.jpg",
                storename: "QUN2zk9R7t3TSHp.jpg",
                size: 232470,
                path: "/2020/07/02/QUN2zk9R7t3TSHp.jpg",
                hash: "lxhOvkJ37f1BLHVw9ndqNgiE2z",
                created_at: 1593702414,
                url: "https://i.loli.net/2020/07/02/QUN2zk9R7t3TSHp.jpg",
                delete: "https://smms.app/delete/lxhOvkJ37f1BLHVw9ndqNgiE2z",
                page: "https://smms.app/image/QUN2zk9R7t3TSHp",
              },
              {
                "width": 3894,
                "height": 2601,
                "filename": "jonatan-pie-V__yW0wQCOs-unsplash.jpg",
                "storename": "cfBA6Zni98UmL7t.jpg",
                "size": 1804755,
                "path": "/2020/07/02/cfBA6Zni98UmL7t.jpg",
                "hash": "WbXVIr3j1kYzCPcNd2wxfD5GQE",
                "created_at": 1593702425,
                "url": "https://i.loli.net/2020/07/02/cfBA6Zni98UmL7t.jpg",
                "delete": "https://smms.app/delete/WbXVIr3j1kYzCPcNd2wxfD5GQE",
                "page": "https://smms.app/image/cfBA6Zni98UmL7t"
              },
              {
                "width": 3970,
                "height": 1990,
                "filename": "飞马广场.jpg",
                "storename": "iODr697TL2YkExv.jpg",
                "size": 2667766,
                "path": "/2020/07/02/iODr697TL2YkExv.jpg",
                "hash": "PAZqKBebDN6YEkC1iRsVUXI2Jp",
                "created_at": 1593702430,
                "url": "https://i.loli.net/2020/07/02/iODr697TL2YkExv.jpg",
                "delete": "https://smms.app/delete/PAZqKBebDN6YEkC1iRsVUXI2Jp",
                "page": "https://smms.app/image/iODr697TL2YkExv"
              }
            ],
            RequestId: "30436E7D-737A-4637-89AF-DAC4D7641555",
          };
        }
        break;
      case "https://smms.app/api/v2/delete/MfDnBpar4qgcHhY9lXiFIo7y5C":
      case "https://smms.app/api/v2/delete/lxhOvkJ37f1BLHVw9ndqNgiE2z":
      case "https://smms.app/api/v2/delete/WbXVIr3j1kYzCPcNd2wxfD5GQE":
      case "https://smms.app/api/v2/delete/PAZqKBebDN6YEkC1iRsVUXI2Jp":
        if (proxy_type === "get" && proxy_header[0] === MOCK_AUTH_HEADER) {
          return {
            "success": true,
            "code": "success",
            "message": "File delete success.",
            "data": [],
            "RequestId": "47804D1F-A1D7-4455-BBBB-45D3A9D3A634"
          };
        }
        break;
    }
  });
};
