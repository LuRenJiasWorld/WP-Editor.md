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
                delete: "https://sm.ms/delete/lxhOvkJ37f1BLHVw9ndqNgiE2z",
                page: "https://sm.ms/image/QUN2zk9R7t3TSHp",
              },
              {
                width: 2848,
                height: 2136,
                filename: "代码.jpg",
                storename: "H3oavYQkcO12Nuy.jpg",
                size: 1586098,
                path: "/2020/07/02/H3oavYQkcO12Nuy.jpg",
                hash: "H2Cx9ekBFP6KlAr4y3vTmUNRtY",
                created_at: 1593702422,
                url: "https://i.loli.net/2020/07/02/H3oavYQkcO12Nuy.jpg",
                delete: "https://sm.ms/delete/H2Cx9ekBFP6KlAr4y3vTmUNRtY",
                page: "https://sm.ms/image/H3oavYQkcO12Nuy",
              },
              {
                width: 3894,
                height: 2601,
                filename: "jonatan-pie-V__yW0wQCOs-unsplash.jpg",
                storename: "cfBA6Zni98UmL7t.jpg",
                size: 1804755,
                path: "/2020/07/02/cfBA6Zni98UmL7t.jpg",
                hash: "WbXVIr3j1kYzCPcNd2wxfD5GQE",
                created_at: 1593702425,
                url: "https://i.loli.net/2020/07/02/cfBA6Zni98UmL7t.jpg",
                delete: "https://sm.ms/delete/WbXVIr3j1kYzCPcNd2wxfD5GQE",
                page: "https://sm.ms/image/cfBA6Zni98UmL7t",
              },
              {
                width: 3038,
                height: 2162,
                filename: "000038.jpg",
                storename: "Anz71CToXk5NxwF.jpg",
                size: 2260324,
                path: "/2020/07/02/Anz71CToXk5NxwF.jpg",
                hash: "QavegSD8EulY2KzMPOkZm6CfiX",
                created_at: 1593702427,
                url: "https://i.loli.net/2020/07/02/Anz71CToXk5NxwF.jpg",
                delete: "https://sm.ms/delete/QavegSD8EulY2KzMPOkZm6CfiX",
                page: "https://sm.ms/image/Anz71CToXk5NxwF",
              },
              {
                width: 3970,
                height: 1990,
                filename: "飞马广场.jpg",
                storename: "iODr697TL2YkExv.jpg",
                size: 2667766,
                path: "/2020/07/02/iODr697TL2YkExv.jpg",
                hash: "PAZqKBebDN6YEkC1iRsVUXI2Jp",
                created_at: 1593702430,
                url: "https://i.loli.net/2020/07/02/iODr697TL2YkExv.jpg",
                delete: "https://sm.ms/delete/PAZqKBebDN6YEkC1iRsVUXI2Jp",
                page: "https://sm.ms/image/iODr697TL2YkExv",
              },
              {
                width: 4800,
                height: 3200,
                filename: "jonatan-pie-xgTMSz6kegE-unsplash.jpg",
                storename: "S5P8kyolF3vemsD.jpg",
                size: 3365093,
                path: "/2020/07/02/S5P8kyolF3vemsD.jpg",
                hash: "8wgByjAbnSWs6KqiaDQNpCJuxe",
                created_at: 1593702432,
                url: "https://i.loli.net/2020/07/02/S5P8kyolF3vemsD.jpg",
                delete: "https://sm.ms/delete/8wgByjAbnSWs6KqiaDQNpCJuxe",
                page: "https://sm.ms/image/S5P8kyolF3vemsD",
              },
              {
                width: 3979,
                height: 2095,
                filename: "2019-12-10_164902_HDR_无移轴_.jpg",
                storename: "6SqC1lHTJsMVYG5.jpg",
                size: 5101247,
                path: "/2020/07/02/6SqC1lHTJsMVYG5.jpg",
                hash: "ku1wf8nOdIzs5YyrpbGMXiHvZ3",
                created_at: 1593702435,
                url: "https://i.loli.net/2020/07/02/6SqC1lHTJsMVYG5.jpg",
                delete: "https://sm.ms/delete/ku1wf8nOdIzs5YyrpbGMXiHvZ3",
                page: "https://sm.ms/image/6SqC1lHTJsMVYG5",
              },
            ],
            RequestId: "30436E7D-737A-4637-89AF-DAC4D7641555",
          };
        }
        break;
    }
  });
};
