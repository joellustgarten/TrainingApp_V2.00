/*
  [@bosch/frontend.kit-npm]  Version: 3.9.0 - 2.8.2024, 06:09:33
  Copyright:  Robert Bosch GmbH, 2024 
*/
/*
  webpack v5.84.1
  
  @license: MIT, https://github.com/webpack/webpack/blob/main/LICENSE

  Copyright (c) 2012-present JS Foundation and other contributors
*/

document.addEventListener("DOMContentLoaded", function () {

  console.log('Script loaded');
  (() => {
    "use strict";
    var t = {
      4135: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = (function (t) {
          function e(e) {
            var n = t.call(this, e) || this;
            return (
              (n.toggleClass = function () {
                n.accordion.classList.toggle("a-accordion--open"),
                  n.accordion.classList.contains("a-accordion--open")
                    ? (n.accordionIcon.classList.remove(
                      "boschicon-bosch-ic-down"
                    ),
                      n.accordionIcon.classList.add("boschicon-bosch-ic-up"),
                      n.accordionIcon.setAttribute("title", "arrow up"),
                      n.accordionButton.setAttribute("aria-expanded", "true"))
                    : (n.accordionIcon.classList.remove(
                      "boschicon-bosch-ic-up"
                    ),
                      n.accordionIcon.classList.add("boschicon-bosch-ic-down"),
                      n.accordionIcon.setAttribute("title", "arrow down"),
                      n.accordionButton.setAttribute("aria-expanded", "false"));
              }),
              (n.accordion = e),
              (n.accordionHead = n.accordion.querySelector(
                ".a-accordion__headline"
              )),
              (n.accordionIcon = n.accordionHead.querySelector(
                ".a-accordion__headline-icon"
              )),
              (n.accordionButton = n.accordionHead.querySelector(
                ".a-accordion__headline-button"
              )),
              (n.accordionContent = e.querySelector(".a-accordion__content")),
              n.accordionHead.addEventListener("click", function () {
                n.toggleClass();
              }),
              n.accordion.addEventListener("keydown", function (t) {
                (" " !== t.key && "Enter" !== t.key && "Spacebar" !== t.key) ||
                  (t.preventDefault(), n.toggleClass());
              }),
              n
            );
          }
          return i(e, t), (e.events = ["onClick"]), e;
        })(n(5249).default);
        e.default = r;
      },
      798: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              }),
          r =
            (this && this.__awaiter) ||
            function (t, e, n, o) {
              return new (n || (n = Promise))(function (i, r) {
                function a(t) {
                  try {
                    c(o.next(t));
                  } catch (t) {
                    r(t);
                  }
                }
                function s(t) {
                  try {
                    c(o.throw(t));
                  } catch (t) {
                    r(t);
                  }
                }
                function c(t) {
                  var e;
                  t.done
                    ? i(t.value)
                    : ((e = t.value),
                      e instanceof n
                        ? e
                        : new n(function (t) {
                          t(e);
                        })).then(a, s);
                }
                c((o = o.apply(t, e || [])).next());
              });
            },
          a =
            (this && this.__generator) ||
            function (t, e) {
              var n,
                o,
                i,
                r,
                a = {
                  label: 0,
                  sent: function () {
                    if (1 & i[0]) throw i[1];
                    return i[1];
                  },
                  trys: [],
                  ops: [],
                };
              return (
                (r = { next: s(0), throw: s(1), return: s(2) }),
                "function" == typeof Symbol &&
                (r[Symbol.iterator] = function () {
                  return this;
                }),
                r
              );
              function s(s) {
                return function (c) {
                  return (function (s) {
                    if (n)
                      throw new TypeError("Generator is already executing.");
                    for (; r && ((r = 0), s[0] && (a = 0)), a;)
                      try {
                        if (
                          ((n = 1),
                            o &&
                            (i =
                              2 & s[0]
                                ? o.return
                                : s[0]
                                  ? o.throw || ((i = o.return) && i.call(o), 0)
                                  : o.next) &&
                            !(i = i.call(o, s[1])).done)
                        )
                          return i;
                        switch (
                        ((o = 0), i && (s = [2 & s[0], i.value]), s[0])
                        ) {
                          case 0:
                          case 1:
                            i = s;
                            break;
                          case 4:
                            return a.label++, { value: s[1], done: !1 };
                          case 5:
                            a.label++, (o = s[1]), (s = [0]);
                            continue;
                          case 7:
                            (s = a.ops.pop()), a.trys.pop();
                            continue;
                          default:
                            if (
                              !((i = a.trys),
                                (i = i.length > 0 && i[i.length - 1]) ||
                                (6 !== s[0] && 2 !== s[0]))
                            ) {
                              a = 0;
                              continue;
                            }
                            if (
                              3 === s[0] &&
                              (!i || (s[1] > i[0] && s[1] < i[3]))
                            ) {
                              a.label = s[1];
                              break;
                            }
                            if (6 === s[0] && a.label < i[1]) {
                              (a.label = i[1]), (i = s);
                              break;
                            }
                            if (i && a.label < i[2]) {
                              (a.label = i[2]), a.ops.push(s);
                              break;
                            }
                            i[2] && a.ops.pop(), a.trys.pop();
                            continue;
                        }
                        s = e.call(t, a);
                      } catch (t) {
                        (s = [6, t]), (o = 0);
                      } finally {
                        n = i = 0;
                      }
                    if (5 & s[0]) throw s[1];
                    return { value: s[0] ? s[1] : void 0, done: !0 };
                  })([s, c]);
                };
              }
            };
        Object.defineProperty(e, "__esModule", { value: !0 });
        var s = n(5916),
          c = n(5249),
          u = 'script[id="'.concat("lottie-script", '"]');
        window.lottie = window.lottie || void 0;
        var l = (function (t) {
          function e(e) {
            var n = t.call(this, e) || this;
            return (
              (n.canvas = n.container.querySelector(
                ".a-animated-icon__container"
              )),
              (n.initEvent = new Event("lottieInitialized")),
              (n.loop = "true" === n.container.dataset.loop),
              (n.autoPlay = "true" === n.container.dataset.autoPlay),
              (n.iconName = n.container.dataset.iconName),
              (n.uiIcon = "true" === n.container.dataset.uiIcon),
              window.addEventListener("lottieInitialized", function () {
                n.initAnimation();
              }),
              (0, s.scriptAdded)(u) ? n.initAnimation() : n.loadScript(),
              n
            );
          }
          return (
            i(e, t),
            (e.prototype.loadScript = function () {
              return r(this, void 0, void 0, function () {
                var t,
                  e = this;
                return a(this, function (n) {
                  return (
                    window.lottie ||
                    (0, s.scriptAdded)(u) ||
                    (((t = document.createElement("script")).type =
                      "text/javascript"),
                      (t.id = "lottie-script"),
                      (t.src =
                        "https://brandguide-cdn.azureedge.net/animated-icons/lottie-web/5.12.2/lottie.min.js"),
                      t.addEventListener("load", function () {
                        window.dispatchEvent(e.initEvent);
                      }),
                      document.head.appendChild(t)),
                    [2]
                  );
                });
              });
            }),
            (e.prototype.createAnimationDataUrl = function () {
              var t = this.uiIcon ? "bosch-ui" : "bosch-ic";
              return ""
                .concat(
                  "https://brandguide-cdn.azureedge.net/animated-icons/0.0.1/bosch-animated-icons-experience",
                  "/"
                )
                .concat(t, "-")
                .concat(this.iconName, "/")
                .concat(t, "-")
                .concat(this.iconName, ".json");
            }),
            (e.prototype.initAnimation = function () {
              return r(this, void 0, void 0, function () {
                var t = this;
                return a(this, function (e) {
                  return (0, s.prefersReducedMotion)()
                    ? [2]
                    : window.lottie
                      ? ((this.animation = window.lottie.loadAnimation({
                        container: this.canvas,
                        renderer: "svg",
                        loop: this.loop,
                        autoplay: this.autoPlay,
                        path: this.createAnimationDataUrl(),
                      })),
                        this.animation.addEventListener("DOMLoaded", function () {
                          t.container.classList.add("-loaded");
                        }),
                        [2])
                      : [2];
                });
              });
            }),
            (e.prototype.play = function () {
              (0, s.prefersReducedMotion)() || this.animation.play();
            }),
            (e.prototype.pause = function () {
              this.animation.pause();
            }),
            e
          );
        })(c.default);
        e.default = l;
      },
      5038: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = n(5249),
          a = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              return (
                e.classList.contains("a-box--modal") &&
                document.body.appendChild(e),
                e.addEventListener("click", function (t) {
                  t.target === e && n.triggerEvent("backgroundClicked");
                }),
                n
              );
            }
            return (
              i(e, t),
              (e.prototype.show = function () {
                this.container.classList.add("-show"),
                  this.isModal() &&
                  document.body.classList.add("-unscrollable");
              }),
              (e.prototype.hide = function () {
                this.container.classList.remove("-show"),
                  document.body.classList.remove("-unscrollable");
              }),
              (e.prototype.isModal = function () {
                return this.container.classList.contains("a-box--modal");
              }),
              (e.events = ["backgroundClicked"]),
              (e.modalId = function (t) {
                return "frontend-kit-modal-".concat(t);
              }),
              (e.findModal = function (t, n) {
                return (
                  void 0 === n &&
                  (n = function (t) {
                    return window.document.getElementById(e.modalId(t));
                  }),
                  n(t)
                );
              }),
              (e.showModal = function (t) {
                var n = e.findModal(t);
                n
                  ? n.component.show()
                  : console.warn(
                    "Could not find a modal with id ".concat(t, " to show.")
                  );
              }),
              (e.hideModal = function (t) {
                var n = e.findModal(t);
                n
                  ? n.component.hide()
                  : console.warn(
                    "Could not find a modal with id ".concat(t, " to hide.")
                  );
              }),
              e
            );
          })(r.default);
        e.default = a;
      },
      7420: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = n(5249),
          a = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              return (
                (n.input = e.querySelector("input")),
                n.input &&
                n.input.addEventListener("change", function () {
                  e.classList.remove("a-checkbox--indeterminate");
                }),
                n
              );
            }
            return i(e, t), e;
          })(r.default);
        e.default = a;
      },
      7780: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = n(5249),
          a = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              return (
                (n.container = e),
                (n.detailsIcon = n.container.querySelector(".a-details__icon")),
                (n.summary = n.container.querySelector("summary")),
                n.container.addEventListener("toggle", n.handleToggle.bind(n)),
                n
              );
            }
            return (
              i(e, t),
              (e.prototype.handleToggle = function () {
                this.container.open
                  ? (this.summary.classList.add("-open"),
                    this.detailsIcon.classList.add("boschicon-bosch-ic-up"),
                    this.detailsIcon.classList.remove(
                      "boschicon-bosch-ic-down"
                    ),
                    this.detailsIcon.setAttribute("title", "arrow up"))
                  : (this.summary.classList.remove("-open"),
                    this.detailsIcon.classList.add("boschicon-bosch-ic-down"),
                    this.detailsIcon.classList.remove("boschicon-bosch-ic-up"),
                    this.detailsIcon.setAttribute("title", "arrow down"));
              }),
              e
            );
          })(r.default);
        e.default = a;
      },
      790: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = (function (t) {
          function e(e) {
            var n = t.call(this, e) || this;
            return (
              (n.colorInput = n.container.querySelector("input")),
              n.colorInput &&
              (n.colorInput.addEventListener("focus", n.handleFocus.bind(n)),
                n.colorInput.addEventListener("blur", n.handleBlur.bind(n)),
                n.colorInput.addEventListener("input", n.handleChange.bind(n)),
                n.colorInput.addEventListener("keyup", n.handleKeyup.bind(n))),
              document.addEventListener("click", n.handleDocumentClick.bind(n)),
              n
            );
          }
          return (
            i(e, t),
            (e.prototype.handleFocus = function () {
              this.container.style.backgroundColor =
                "var(--neutral__focused__fill__default)";
            }),
            (e.prototype.handleBlur = function () {
              (this.container.style.backgroundColor = ""),
                this.container.classList.remove("-focus-visible");
            }),
            (e.prototype.handleChange = function (t) {
              var e = t.target.value;
              this.container.style.setProperty("--before-color", e);
            }),
            (e.prototype.handleKeyup = function (t) {
              "Tab" === t.key || "Shift" === t.key
                ? this.container.classList.add("-focus-visible")
                : this.container.classList.remove("-focus-visible");
            }),
            (e.prototype.handleDocumentClick = function (t) {
              this.container.contains(t.target) ||
                this.container.classList.remove("-focus-visible");
            }),
            e
          );
        })(n(5249).default);
        e.default = r;
      },
      4797: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = (function (t) {
          function e(e) {
            var n = t.call(this, e) || this;
            return (
              (n.fileUploadInput = n.container.querySelector("input")),
              (n.fileUploadLabel = n.container.querySelector("label")),
              n.fileUploadInput &&
              (n.fileUploadInput.addEventListener(
                "change",
                n.updateImageDisplay.bind(n)
              ),
                n.fileUploadLabel.addEventListener("click", function (t) {
                  t.preventDefault(), n.fileUploadInput.click();
                }),
                n.fileUploadInput.addEventListener(
                  "focus",
                  n.handleFocus.bind(n)
                ),
                n.fileUploadInput.addEventListener(
                  "blur",
                  n.handleBlur.bind(n)
                )),
              n
            );
          }
          return (
            i(e, t),
            (e.prototype.handleFocus = function () {
              this.container.classList.add("-focus-visible");
            }),
            (e.prototype.handleBlur = function () {
              this.container.classList.remove("-focus-visible");
            }),
            (e.prototype.updateImageDisplay = function (t) {
              var e = t.target,
                n = e.files,
                o = e.nextElementSibling;
              n.length > 0
                ? ((o.innerHTML = ""),
                  Array.from(n).forEach(function (t) {
                    var e = document.createElement("p");
                    (e.textContent = t.name), o.appendChild(e);
                  }))
                : (o.innerHTML = "<p>No file chosen</p>");
            }),
            e
          );
        })(n(5249).default);
        e.default = r;
      },
      3665: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = n(5249),
          a = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              return (
                (n.toggleIcon = e.querySelector(
                  ".a-password-input__icon-password"
                )),
                (n.input = e.querySelector("input")),
                n.toggleIcon instanceof HTMLElement &&
                n.toggleIcon.addEventListener("click", function () {
                  var t = n.input,
                    o = n.toggleIcon.querySelector(".a-icon");
                  o.classList.remove("ui-ic-watch-off", "ui-ic-watch-on"),
                    "password" === t.getAttribute("type")
                      ? (e.classList.add("-password-visible"),
                        t.setAttribute("type", "text"),
                        o.classList.add("ui-ic-watch-off"))
                      : (e.classList.remove("-password-visible"),
                        t.setAttribute("type", "password"),
                        o.classList.add("ui-ic-watch-on"));
                }),
                n
              );
            }
            return i(e, t), e;
          })(r.default);
        e.default = a;
      },
      4194: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 }),
          (e.EVENT_ON_INPUT = void 0);
        var r = n(5249);
        e.EVENT_ON_INPUT = "onInput";
        var a = (function (t) {
          function n(n) {
            var o = t.call(this, n) || this;
            return (
              !0 === o.alreadyInitialized ||
              ((o.resetInputValue = o.resetInputValue.bind(o)),
                (o.focusInput = o.focusInput.bind(o)),
                (o.resetInputAndHideButton = o.resetInputAndHideButton.bind(o)),
                (o.showCloseButton = o.showCloseButton.bind(o)),
                (o.hideCloseButton = o.hideCloseButton.bind(o)),
                (o.getInputLength = o.getInputLength.bind(o)),
                (o.handleInput = o.handleInput.bind(o)),
                (o.searchInput = o.container.querySelector(
                  ".a-search-input input"
                )),
                (o.closeButton = o.container.querySelector(
                  ".a-search-input__icon-close"
                )),
                o.searchInput &&
                o.searchInput.addEventListener("input", function (t) {
                  var n = t.target.value;
                  o.handleInput(), o.triggerEvent(e.EVENT_ON_INPUT, n);
                }),
                o.closeButton &&
                o.closeButton.addEventListener("click", function () {
                  o.resetInputAndHideButton(), o.focusInput();
                })),
              o
            );
          }
          return (
            i(n, t),
            (n.prototype.handleInput = function () {
              "" !== this.searchInput.value.trim()
                ? this.showCloseButton()
                : this.hideCloseButton();
            }),
            (n.prototype.hideCloseButton = function () {
              this.alwaysShowCloseButton ||
                this.container.classList.remove("--close-visible");
            }),
            (n.prototype.showCloseButton = function () {
              this.container.classList.add("--close-visible");
            }),
            (n.prototype.resetInputValue = function () {
              (this.searchInput.value = ""),
                this.triggerEvent(e.EVENT_ON_INPUT, "");
            }),
            (n.prototype.resetInputAndHideButton = function () {
              this.resetInputValue(), this.hideCloseButton();
            }),
            (n.prototype.focusInput = function () {
              this.searchInput.focus();
            }),
            (n.prototype.getInputLength = function () {
              return this.searchInput.value.length;
            }),
            (n.prototype.setAlwaysShowCloseButton = function (t) {
              (this.alwaysShowCloseButton = t),
                t ? this.showCloseButton() : this.hideCloseButton();
            }),
            (n.events = [e.EVENT_ON_INPUT]),
            n
          );
        })(r.default);
        e.default = a;
      },
      6359: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = n(5249),
          a = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              return (
                (n.input = e.querySelector("input")),
                (n.editButton = e.querySelector(".a-text-field__icon-edit")),
                (n.clearButton = e.querySelector(".a-text-field__icon-close")),
                n.container.classList.contains("a-text-field--integrated") &&
                (n.input.addEventListener("focus", function () {
                  n.showClearButton.bind(n)();
                }),
                  n.editButton.addEventListener("focus", function () {
                    n.showClearButton.bind(n)(), n.input.focus();
                  }),
                  n.editButton.addEventListener("click", function () {
                    n.showClearButton.bind(n)(), n.input.focus();
                  }),
                  e.addEventListener("focusout", function (t) {
                    t.relatedTarget !== n.clearButton && n.hideClearButton();
                  }),
                  n.clearButton.addEventListener(
                    "click",
                    n.resetInputAndHideButton.bind(n)
                  )),
                n
              );
            }
            return (
              i(e, t),
              (e.prototype.hideClearButton = function () {
                (this.clearButton.style.display = "none"),
                  (this.editButton.style.display = "inline-flex");
              }),
              (e.prototype.showClearButton = function () {
                (this.clearButton.style.display = "inline-flex"),
                  (this.editButton.style.display = "none");
              }),
              (e.prototype.resetInputValue = function () {
                this.input.value = "";
              }),
              (e.prototype.setInputFocus = function () {
                this.input.focus();
              }),
              (e.prototype.resetInputAndHideButton = function () {
                this.resetInputValue(),
                  this.hideClearButton(),
                  this.clearButton.blur(),
                  this.triggerEvent("onClear");
              }),
              (e.events = ["onClear"]),
              e
            );
          })(r.default);
        e.default = a;
      },
      8740: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = n(5249),
          a = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              return (
                (n.minusButton = e.querySelector(
                  ".".concat("a-value-modificator__minus-button")
                )),
                (n.plusButton = e.querySelector(
                  ".".concat("a-value-modificator__plus-button")
                )),
                (n.input = e.querySelector("input")),
                n.input instanceof HTMLInputElement &&
                (n.input.value || (n.input.value = "0")),
                n.minusButton instanceof HTMLElement &&
                (n.initElement(n.minusButton),
                  (n.minusButton.onclick = function () {
                    n.stepDownInputValue();
                  }),
                  n.minusButton.addEventListener("mousedown", function () {
                    n.togglePressed(n.minusButton);
                  }),
                  n.minusButton.addEventListener("mouseup", function () {
                    n.togglePressed(n.minusButton);
                  })),
                n.plusButton instanceof HTMLElement &&
                (n.initElement(n.plusButton),
                  (n.plusButton.onclick = function () {
                    n.stepUpInputValue();
                  }),
                  n.plusButton.addEventListener("mousedown", function () {
                    n.togglePressed(n.plusButton);
                  }),
                  n.plusButton.addEventListener("mouseup", function () {
                    n.togglePressed(n.plusButton);
                  })),
                n
              );
            }
            return (
              i(e, t),
              (e.prototype.initElement = function (t) {
                this.input.value === this.input.min &&
                  t === this.minusButton &&
                  this.disable(t),
                  this.input.value === this.input.max &&
                  t === this.plusButton &&
                  this.disable(t);
              }),
              (e.prototype.stepUpInputValue = function () {
                if (
                  !this.container.classList.contains("-disabled") &&
                  !this.container.classList.contains("-readonly")
                ) {
                  var t =
                    (Number.isNaN(this.input.valueAsNumber)
                      ? 0
                      : this.input.valueAsNumber) + +this.input.step;
                  this.enable(this.minusButton),
                    t >= +this.input.max &&
                    (this.disable(this.plusButton), (t = +this.input.max)),
                    (this.input.value = t.toString()),
                    this.triggerEvent("onInput", t);
                }
              }),
              (e.prototype.stepDownInputValue = function () {
                if (
                  !this.container.classList.contains("-disabled") &&
                  !this.container.classList.contains("-readonly")
                ) {
                  var t =
                    (Number.isNaN(this.input.valueAsNumber)
                      ? 0
                      : this.input.valueAsNumber) - +this.input.step;
                  this.enable(this.plusButton),
                    t <= +this.input.min &&
                    (this.disable(this.minusButton), (t = +this.input.min)),
                    (this.input.value = t.toString()),
                    this.triggerEvent("onInput", t);
                }
              }),
              (e.prototype.disable = function (t) {
                t.setAttribute("disabled", "");
              }),
              (e.prototype.enable = function (t) {
                t.removeAttribute("disabled");
              }),
              (e.prototype.togglePressed = function (t) {
                this.container.classList.contains("-disabled") ||
                  this.container.classList.contains("-readonly") ||
                  (t.classList.contains("-pressed")
                    ? t.classList.remove("-pressed")
                    : t.classList.add("-pressed"));
              }),
              (e.prototype.setValue = function (t) {
                var e = Number.isNaN(t) ? this.input.value : t;
                (this.input.value = e.toString()),
                  this.triggerEvent("onInput", e);
              }),
              (e.events = ["onInput"]),
              e
            );
          })(r.default);
        e.default = a;
      },
      1762: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = (function (t) {
          function e(n) {
            var o = t.call(this, n) || this;
            return (
              new MutationObserver(e.callback).observe(
                n.querySelector("meter"),
                {
                  childList: !1,
                  subtree: !1,
                  attributes: !0,
                  attributeFilter: ["data-progress"],
                }
              ),
              o
            );
          }
          return (
            i(e, t),
            (e.callback = function (t) {
              t.forEach(function (t) {
                var e = t.target.dataset.progress;
                t.target.setAttribute("value", e),
                  t.target.setAttribute("aria-valuenow", e);
              });
            }),
            e
          );
        })(n(5249).default);
        e.default = r;
      },
      5158: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = n(5249),
          a = n(4123),
          s = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              (n.escapeKeyHelper = new a.default(
                n.hide.bind(n),
                n.isVisible.bind(n)
              )),
                e.classList.contains("a-notification--banner") &&
                document.body.appendChild(e);
              var o = e.querySelector('[data-frok-action="close"]');
              return (
                o &&
                o.addEventListener("click", function () {
                  n.triggerEvent("closeClicked");
                }),
                n
              );
            }
            return (
              i(e, t),
              (e.prototype.show = function () {
                this.container.classList.add("-show"),
                  this.escapeKeyHelper.enable();
              }),
              (e.prototype.hide = function () {
                this.container.classList.remove("-show");
              }),
              (e.prototype.isVisible = function () {
                return this.container.classList.contains("-show");
              }),
              (e.events = ["closeClicked"]),
              (e.notificationId = function (t) {
                return "frontend-kit-notification-".concat(t);
              }),
              (e.findNotification = function (t, n) {
                return (
                  void 0 === n &&
                  (n = function (t) {
                    return window.document.getElementById(
                      e.notificationId(t)
                    );
                  }),
                  n(t)
                );
              }),
              (e.showNotification = function (t) {
                var n = e.findNotification(t);
                n
                  ? n.component.show()
                  : console.warn(
                    "Could not find a notification with id ".concat(
                      t,
                      " to show"
                    )
                  );
              }),
              (e.hideNotification = function (t) {
                var n = e.findNotification(t);
                n
                  ? n.component.hide()
                  : console.warn(
                    "Could not find a notification with id ".concat(
                      t,
                      " to hide"
                    )
                  );
              }),
              e
            );
          })(r.default);
        e.default = s;
      },
      4718: (t, e) => {
        Object.defineProperty(e, "__esModule", { value: !0 });
        e.default = function (t, e, n, o) {
          void 0 === n && (n = 1), void 0 === o && (o = 7);
          var i = [];
          if (e <= o)
            return Array.from({ length: e + 1 }, function (t, e) {
              return e;
            }).slice(1);
          for (var r = Math.max(2, t - n); r <= Math.min(e - 1, t + n); r += 1)
            i.push(r);
          if (
            (t - n > 3 && i.unshift("..."),
              t + n < e - 2 && i.push("..."),
              i.length < o - 2 * n)
          ) {
            if (t < o - 2 * n) {
              i.length = 0;
              for (r = 1; r <= o - 2; r += 1) i.push(r);
              return i.push("..."), i.push(e), i;
            }
            (i.length = 0), i.push(1, "...");
            var a = i.length;
            for (r = e; r > e - (o - a); r -= 1) i.splice(a, 0, r);
            return i;
          }
          return i.unshift(1), i.push(e), i;
        };
      },
      4182: (t, e) => {
        Object.defineProperty(e, "__esModule", { value: !0 });
        e.default = function (t, e) {
          t.forEach(function (t) {
            var n = parseInt(t.getAttribute("data-index"), 10);
            t.setAttribute("aria-current", (n === e).toString()),
              n === e
                ? t.classList.add("-selected")
                : t.classList.contains("-selected") &&
                t.classList.remove("-selected");
          });
        };
      },
      6258: (t, e, n) => {
        Object.defineProperty(e, "__esModule", { value: !0 });
        var o = n(4718);
        e.default = function (t, e, n) {
          (0, o.default)(t, e).forEach(function (e, o) {
            "number" == typeof e
              ? ((n[o].querySelector("span").textContent = e.toString()),
                n[o].setAttribute("data-index", e.toString()),
                n[o].setAttribute("aria-current", (e === t).toString()),
                n[o].removeAttribute("tabindex"))
              : "string" == typeof e &&
              ((n[o].querySelector("span").textContent = "..."),
                n[o].removeAttribute("data-index"),
                n[o].setAttribute(
                  "aria-current",
                  (parseInt(e, 10) === t).toString()
                ),
                n[o].setAttribute("tabindex", "-1"));
          });
        };
      },
      9023: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              }),
          r =
            (this && this.__spreadArray) ||
            function (t, e, n) {
              if (n || 2 === arguments.length)
                for (var o, i = 0, r = e.length; i < r; i++)
                  (!o && i in e) ||
                    (o || (o = Array.prototype.slice.call(e, 0, i)),
                      (o[i] = e[i]));
              return t.concat(o || Array.prototype.slice.call(e));
            };
        Object.defineProperty(e, "__esModule", { value: !0 });
        var a = n(5249),
          s = n(4182),
          c = n(6258),
          u = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              (n.indicators = e.querySelectorAll(
                ".a-page-indicator__indicator"
              )),
                (n.arrowLeft = e.querySelector(
                  ".a-page-indicator__caret.-left"
                )),
                (n.arrowRight = e.querySelector(
                  ".a-page-indicator__caret.-right"
                )),
                (n.isNumbered = e.classList.contains(
                  "a-page-indicator--numbered"
                ));
              var o = parseInt(e.getAttribute("data-start-index"), 10) || 0,
                i =
                  parseInt(e.getAttribute("data-max-length"), 10) ||
                  n.indicators.length;
              return (
                n.setMaxLength(i),
                n.setActiveIndex(o),
                n.arrowLeft instanceof HTMLElement &&
                n.arrowLeft.addEventListener("click", function () {
                  n.prev(), n.triggerEvent("prevClicked");
                }),
                n.arrowRight instanceof HTMLElement &&
                n.arrowRight.addEventListener("click", function () {
                  n.next(), n.triggerEvent("nextClicked");
                }),
                n.indicators &&
                r([], n.indicators, !0).forEach(function (t) {
                  t.addEventListener("click", function () {
                    var e = parseInt(t.getAttribute("data-index"), 10);
                    n.setActiveIndex(e), n.triggerEvent("clicked", e);
                  });
                }),
                n
              );
            }
            return (
              i(e, t),
              (e.prototype.setActiveIndex = function (t) {
                return (
                  t > 0 &&
                  t <= this.maxLength &&
                  ((this.activeIndex = t),
                    this.isNumbered &&
                    ((0, c.default)(
                      this.activeIndex,
                      this.maxLength,
                      this.indicators
                    ),
                      this.updateArrowStyle()),
                    (0, s.default)(this.indicators, this.activeIndex),
                    this.triggerEvent("indexChanged", t)),
                  this.activeIndex
                );
              }),
              (e.prototype.setMaxLength = function (t) {
                return (
                  (this.maxLength = t),
                  this.triggerEvent("maxLengthChanged", this.maxLength),
                  this.maxLength
                );
              }),
              (e.prototype.prev = function (t) {
                void 0 === t && (t = 1);
                var e = this.activeIndex - t;
                return this.setActiveIndex(e);
              }),
              (e.prototype.next = function (t) {
                void 0 === t && (t = 1);
                var e = this.activeIndex + t;
                return this.setActiveIndex(e);
              }),
              (e.prototype.updateArrowStyle = function () {
                this.activeIndex <= 1 &&
                  !this.arrowLeft.classList.contains("-end")
                  ? (this.arrowLeft.classList.add("-end"),
                    this.arrowLeft.setAttribute("aria-disabled", "true"),
                    this.arrowRight.classList.remove("-end"),
                    this.arrowRight.setAttribute("aria-disabled", "false"))
                  : this.activeIndex >= this.maxLength &&
                    !this.arrowRight.classList.contains("-end")
                    ? (this.arrowRight.classList.add("-end"),
                      this.arrowRight.setAttribute("aria-disabled", "true"),
                      this.arrowLeft.classList.remove("-end"),
                      this.arrowLeft.setAttribute("aria-disabled", "false"))
                    : (this.arrowLeft.classList.remove("-end"),
                      this.arrowLeft.setAttribute("aria-disabled", "false"),
                      this.arrowRight.classList.remove("-end"),
                      this.arrowRight.setAttribute("aria-disabled", "false"));
              }),
              (e.events = [
                "clicked",
                "nextClicked",
                "prevClicked",
                "indexChanged",
                "maxLengthChanged",
              ]),
              e
            );
          })(a.default);
        e.default = u;
      },
      4688: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = (function (t) {
          function e(n) {
            var o = t.call(this, n) || this;
            return (
              new MutationObserver(e.callback).observe(
                n.querySelector("progress"),
                {
                  childList: !1,
                  subtree: !1,
                  attributes: !0,
                  attributeFilter: ["data-progress"],
                }
              ),
              o
            );
          }
          return (
            i(e, t),
            (e.setWidth = function (t, e) {
              t.setAttribute("style", "width:".concat(e, "%"));
            }),
            (e.callback = function (t) {
              t.forEach(function (t) {
                var n = t.target.nextElementSibling,
                  o = t.target.dataset.progress;
                t.target.setAttribute("value", o),
                  e.setWidth(n, t.target.dataset.progress);
              });
            }),
            e
          );
        })(n(5249).default);
        e.default = r;
      },
      4028: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = n(5249),
          a = 0,
          s = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              return (
                (n.setRatingStars = function (t, e) {
                  var o = t;
                  t > n.stars.length && (o = n.stars.length),
                    e && (a = o),
                    n.stars.forEach(function (t, e) {
                      var n = t.nextElementSibling,
                        i = e + 1,
                        r = o % 1 != 0 && i === Math.ceil(o),
                        a = i > o && !r;
                      i <= o &&
                        n instanceof HTMLElement &&
                        (n.classList.remove("ui-ic-nosafe-star"),
                          n.classList.remove("ui-ic-nosafe-star-half"),
                          n.classList.add("ui-ic-nosafe-star-fill")),
                        r &&
                        n instanceof HTMLElement &&
                        (n.classList.remove("ui-ic-nosafe-star"),
                          n.classList.remove("ui-ic-nosafe-star-fill"),
                          n.classList.add("ui-ic-nosafe-star-half")),
                        a &&
                        n instanceof HTMLElement &&
                        (n.classList.remove("ui-ic-nosafe-star-fill"),
                          n.classList.remove("ui-ic-nosafe-star-half"),
                          n.classList.add("ui-ic-nosafe-star"));
                    });
                }),
                (n.setRatingLabel = function (t) {
                  var e = n.container.querySelector(".a-rating__label"),
                    o = n.isLink
                      ? "".concat(t)
                      : "(".concat(t, "/").concat(n.stars.length, ")");
                  e instanceof HTMLElement && (e.innerText = o);
                }),
                (n.getRating = function () {
                  var t = n.container.querySelector(".a-rating__label");
                  return t instanceof HTMLElement ? parseFloat(t.innerText) : 0;
                }),
                (n.isLink = e.classList.contains("a-rating--link")),
                n.isLink
                  ? (n.stars = e.querySelectorAll(
                    ".a-rating__star-container .a-icon"
                  ))
                  : (n.stars = e.querySelectorAll('input[type="radio"]')),
                (n.starLabels = e.querySelectorAll("label")),
                n.isLink ||
                (n.starLabels.forEach(function (t) {
                  if (t instanceof HTMLLabelElement) {
                    var e = t.querySelector('input[type="radio"]'),
                      o = parseInt(e.value, 10);
                    t.addEventListener("click", function () {
                      n.setRatingStars(o, !0), n.setRatingLabel(o);
                    });
                     /* t.addEventListener("mouseover", function () {
                        n.setRatingStars(o, !1);
                      }); */
                  }
                }),
                  /*e.addEventListener("mouseout", function () {
                    n.setRatingStars(a, !1);
                  })),*/n).
                n
              );
            }
            return i(e, t), e;
          })(r.default);
        e.default = s;
      },
      7160: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = (function (t) {
          function e(e) {
            var n = t.call(this, e) || this;
            if (
              ((n.slider = e.querySelector(".a-slider input[type=range]")),
                (n.sliderVertical = e.querySelector(
                  ".a-slider--vertical input[type=range]"
                )),
                (n.tooltip = e.querySelector(".a-tooltip")),
                (n.label = e.querySelector("label")),
                n.slider instanceof HTMLElement &&
                (n.slider.addEventListener("input", function () {
                  n.setTooltip(),
                    n.setValue(),
                    n.setAriaValueNow(),
                    n.setFillColorActiveRail();
                }),
                  n.slider.addEventListener("mouseenter", function () {
                    n.toggleTooltipVisibility(!1);
                  }),
                  n.slider.addEventListener("mouseleave", function () {
                    n.toggleTooltipVisibility(!0);
                  })),
                n.sliderVertical)
            ) {
              var o = n.slider.offsetWidth;
              n.label && (n.label.style.left = "".concat(o + 8, "px"));
            }
            return n;
          }
          return (
            i(e, t),
            (e.prototype.setValue = function () {
              this.slider.setAttribute(
                "value",
                this.slider.valueAsNumber.toString()
              );
            }),
            (e.prototype.setAriaValueNow = function () {
              this.slider.setAttribute(
                "aria-valuenow",
                this.slider.valueAsNumber.toString()
              );
            }),
            (e.prototype.setTooltip = function () {
              if (this.tooltip) {
                var t = this.calculateValues().percentage;
                "relative" === this.tooltip.getAttribute("tooltip-type")
                  ? (this.tooltip.innerHTML = "".concat(t, " %"))
                  : this.tooltip.getAttribute("tooltip-unit")
                    ? (this.tooltip.innerHTML = ""
                      .concat(this.slider.value)
                      .concat(this.tooltip.getAttribute("tooltip-unit")))
                    : (this.tooltip.innerHTML = this.slider.value),
                  this.calculateAndSetTooltipPosition(t);
              }
            }),
            (e.prototype.calculateAndSetTooltipPosition = function (t) {
              var e = this.tooltip.offsetWidth / 2 / 16 + 1.5 * (t / 100 - 0.5);
              if (
                ((this.tooltip.style.left = "calc("
                  .concat(t, "% - (")
                  .concat(e, "rem))")),
                  this.sliderVertical)
              ) {
                var n = this.slider.valueAsNumber.toString(),
                  o = void 0;
                "relative" === this.tooltip.getAttribute("tooltip-type")
                  ? ((o = -3.5),
                    2 === n.length ? (o = -3.8) : n.length > 2 && (o = -4.2))
                  : this.label
                    ? ((o = -3.25),
                      2 === n.length ? (o = -3.5) : n.length > 2 && (o = -3.75))
                    : ((o = -2.9),
                      2 === n.length
                        ? (o = -3.25)
                        : 3 === n.length
                          ? (o = -3.5)
                          : n.length > 3 && (o = -3.8)),
                  (this.tooltip.style.bottom = "".concat(o, "rem"));
              }
            }),
            (e.prototype.toggleTooltipVisibility = function (t) {
              this.tooltip &&
                (this.tooltip.style.visibility = t ? "hidden" : "visible");
            }),
            (e.prototype.calculateValues = function () {
              var t = this.slider.min ? Number(this.slider.min) : 0,
                e = this.slider.max ? Number(this.slider.max) : 100;
              return {
                percentage: Number(
                  (100 * (this.slider.valueAsNumber - t)) / (e - t)
                ),
              };
            }),
            (e.prototype.setFillColorActiveRail = function () {
              var t = this.calculateValues().percentage;
              this.slider.style.setProperty(
                "--slider-percentage",
                "".concat(t)
              );
            }),
            (e.events = ["onClick"]),
            e
          );
        })(n(5249).default);
        e.default = r;
      },
      3031: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = n(5249);
        function a(t) {
          return t instanceof HTMLButtonElement;
        }
        var s = (function (t) {
          function e(e) {
            var n = t.call(this, e) || this;
            return (
              (n.updateTimeout = null),
              (n.scrollLeft = 0),
              (n.scrollRight = 0),
              (n.scrollPadding = 16),
              (n.scrollIntoViewPadding = 20),
              (n.wrapper = e.parentElement),
              (n.tabs = e.querySelectorAll(".a-tab-navigation__tab")),
              (n.tabNavigations = e),
              (n.scrollLeftButton = n.wrapper.querySelector(
                ".a-tab-navigation__button-left"
              )),
              (n.scrollRightButton = n.wrapper.querySelector(
                ".a-tab-navigation__button-right"
              )),
              n.scrollLeftButton.addEventListener("click", function () {
                e.scrollBy({ left: -150, behavior: "smooth" });
              }),
              n.scrollRightButton.addEventListener("click", function () {
                e.scrollBy({ left: 150, behavior: "smooth" });
              }),
              Array.from(n.tabs).forEach(function (t) {
                t instanceof HTMLElement &&
                  (t.addEventListener("scrollToView", function () {
                    var o = e.getBoundingClientRect(),
                      i = t.getBoundingClientRect(),
                      r = i.right - o.right + n.scrollIntoViewPadding,
                      a = o.left - i.left + n.scrollIntoViewPadding;
                    r > 0 &&
                      e.scrollBy({ top: 0, left: r, behavior: "smooth" }),
                      a > 0 &&
                      e.scrollBy({ top: 0, left: -a, behavior: "smooth" });
                  }),
                    t.addEventListener("click", function () {
                      t.classList.contains("-selected") ||
                        t.classList.contains("-disabled") ||
                        (n.deselectAllTabs(),
                          t.classList.add("-selected"),
                          t.setAttribute(
                            a(t) ? "aria-pressed" : "aria-selected",
                            "true"
                          ),
                          n.triggerEvent("selected", t.dataset.frokTabIdentifier),
                          t.dispatchEvent(new CustomEvent("scrollToView")));
                    }));
              }),
              n.registerScrollUpdates(),
              n
            );
          }
          return (
            i(e, t),
            (e.prototype.deselectAllTabs = function () {
              Array.from(this.tabs).forEach(function (t) {
                t instanceof HTMLElement &&
                  (t.classList.remove("-selected"),
                    t.removeAttribute(a(t) ? "aria-pressed" : "aria-selected"));
              });
            }),
            (e.prototype.registerScrollUpdates = function () {
              var t = this;
              this.updateTimeout = null;
              var e = function () {
                t.updateTimeout ||
                  (t.updateTimeout = setTimeout(function () {
                    return t.updateScrollingInformation();
                  }, 100));
              };
              e(),
                window.addEventListener("resize", e),
                this.tabNavigations.addEventListener("scroll", e);
            }),
            (e.prototype.updateScrollingInformation = function () {
              clearTimeout(this.updateTimeout),
                (this.scrollLeft = this.tabNavigations.scrollLeft),
                (this.scrollRight =
                  this.tabNavigations.scrollWidth -
                  this.tabNavigations.offsetWidth -
                  this.scrollLeft),
                this.toggleScrollingClass();
            }),
            (e.prototype.toggleScrollingClass = function () {
              (this.updateTimeout = null),
                this.wrapper &&
                (this.wrapper.classList.toggle(
                  "a-tab-navigation--scrollLeft",
                  this.scrollLeft > 1 + this.scrollPadding
                ),
                  this.wrapper.classList.toggle(
                    "a-tab-navigation--scrollRight",
                    this.scrollRight > 1 + this.scrollPadding
                  ));
            }),
            (e.events = ["selected"]),
            e
          );
        })(r.default);
        e.default = s;
      },
      5508: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = n(5249),
          a = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              return (
                (n.textArea = e.querySelector("textarea")),
                (n.shadow = e.querySelector(".a-text-area__shadow")),
                n.shadow &&
                n.textArea instanceof HTMLTextAreaElement &&
                n.textArea.addEventListener("input", function () {
                  (n.shadow.textContent = "".concat(
                    n.textArea.value,
                    "\r\n"
                  )),
                    (n.textArea.style.height = "".concat(
                      n.shadow.offsetHeight,
                      "px"
                    ));
                }),
                n
              );
            }
            return i(e, t), (e.events = ["onInput"]), e;
          })(r.default);
        e.default = a;
      },
      8251: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = n(5249),
          a = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              return (
                !0 === n.alreadyInitialized ||
                ((n.timelineDurationValue = 0),
                  (n.timelineCurrentValue = 0),
                  (n.timelineDuration = e.querySelector(
                    ".a-timeline__duration"
                  )),
                  (n.timelineCurrent = e.querySelector(".a-timeline__current")),
                  (n.timelineRange = e.querySelector(
                    ".a-timeline__range input[type=range]"
                  )),
                  n.timelineRange instanceof HTMLElement &&
                  ((n.timelineDurationValue = parseInt(
                    n.timelineRange.max,
                    10
                  )),
                    (n.timelineCurrentValue = parseInt(
                      n.timelineRange.value,
                      10
                    )),
                    n.setDurationMarkup(),
                    n.setCurrentMarkup(),
                    n.setCurrentFillColorActiveRail(),
                    n.timelineRange.addEventListener("input", function () {
                      n.setCurrent(parseInt(n.timelineRange.value, 10)),
                        n.triggerEvent("onRangeChange", n.timelineCurrentValue);
                    }),
                    n.timelineRange.addEventListener("mouseup", function (t) {
                      n.triggerEvent("onMouseup", t);
                    }),
                    n.timelineRange.addEventListener("focus", function (t) {
                      n.triggerEvent("onFocus", t);
                    }),
                    n.timelineRange.addEventListener("keyup", function (t) {
                      n.triggerEvent("onKeyup", t);
                    }))),
                n
              );
            }
            return (
              i(e, t),
              (e.prototype.formatTime = function (t) {
                var e = Math.floor(t / 60),
                  n = Math.floor(t % 60);
                return "".concat(e, ":").concat(n.toString().padStart(2, "0"));
              }),
              (e.prototype.setCurrent = function (t) {
                t > this.timelineDurationValue
                  ? (this.timelineCurrentValue = this.timelineDurationValue)
                  : (this.timelineCurrentValue = t < 0 ? 0 : Math.floor(t)),
                  this.setCurrentMarkup(),
                  this.setCurrentFillColorActiveRail();
              }),
              (e.prototype.setDuration = function (t) {
                (this.timelineDurationValue = t < 0 ? 0 : Math.floor(t)),
                  (this.timelineRange.max =
                    this.timelineDurationValue.toString()),
                  this.setDurationMarkup();
              }),
              (e.prototype.setPlayingState = function (t) {
                t
                  ? this.container.classList.add("-playing")
                  : this.container.classList.remove("-playing");
              }),
              (e.prototype.setCurrentMarkup = function () {
                (this.timelineRange.value =
                  this.timelineCurrentValue.toString()),
                  this.timelineRange.setAttribute(
                    "value",
                    this.timelineCurrentValue.toString()
                  ),
                  (this.timelineCurrent.textContent = this.formatTime(
                    this.timelineCurrentValue
                  )),
                  this.setCurrentAriaValues();
              }),
              (e.prototype.setDurationMarkup = function () {
                (this.timelineDuration.textContent = this.formatTime(
                  this.timelineDurationValue
                )),
                  this.setDurationAriaValues();
              }),
              (e.prototype.setCurrentAriaValues = function () {
                this.timelineRange.setAttribute(
                  "aria-valuenow",
                  this.timelineCurrentValue.toString()
                ),
                  this.timelineRange.setAttribute(
                    "aria-valuetext",
                    "elapsed time: ".concat(
                      this.formatTime(this.timelineCurrentValue)
                    )
                  );
              }),
              (e.prototype.setDurationAriaValues = function () {
                this.timelineRange.setAttribute(
                  "aria-valuemax",
                  this.timelineDurationValue.toString()
                ),
                  this.timelineRange.setAttribute(
                    "aria-description",
                    "total time: ".concat(
                      this.formatTime(this.timelineDurationValue)
                    )
                  );
              }),
              (e.prototype.calculateValues = function () {
                var t = 0;
                return (
                  0 !== this.timelineDurationValue &&
                  (t = Number(
                    (
                      (100 * this.timelineCurrentValue) /
                      this.timelineDurationValue
                    ).toFixed(2)
                  )),
                  { percentage: t }
                );
              }),
              (e.prototype.setCurrentFillColorActiveRail = function () {
                var t = this.calculateValues().percentage;
                this.timelineRange.style.setProperty(
                  "--timeline-range-percentage",
                  "".concat(t)
                );
              }),
              (e.events = ["onRangeChange", "onMouseup", "onFocus", "onKeyup"]),
              e
            );
          })(r.default);
        e.default = a;
      },
      5249: (t, e) => {
        Object.defineProperty(e, "__esModule", { value: !0 });
        var n = function (t, e) {
          if (!t.events.includes(e))
            throw new Error(
              "Unknown event ".concat(e, " in component ").concat(t.name, ".")
            );
        },
          o = function (t) {
            var e = this;
            (this.alreadyInitialized = !1),
              (this.eventRegistry = {}),
              (this.addEventListener = function (t, o) {
                n(e.constructor, t);
                var i = e.eventRegistry[t].push(o) - 1;
                return function () {
                  e.eventRegistry[t][i] = null;
                };
              }),
              (this.removeEventListener = function (t, o) {
                n(e.constructor, t),
                  (e.eventRegistry[t] = e.eventRegistry[t].map(function (t) {
                    return t === o ? null : t;
                  }));
              }),
              (this.triggerEvent = function (t) {
                for (var n = [], o = 1; o < arguments.length; o++)
                  n[o - 1] = arguments[o];
                (e.eventRegistry[t] || []).forEach(function (t) {
                  "function" == typeof t && t.apply(void 0, n);
                });
              }),
              (this.container = t);
            var o = this.constructor;
            o.events &&
              o.events.forEach(function (t) {
                e.eventRegistry[t] = [];
              }),
              t.component
                ? (this.alreadyInitialized = !0)
                : Object.defineProperty(t, "component", {
                  get: function () {
                    return e;
                  },
                });
          };
        e.default = o;
      },
      5916: (t, e) => {
        Object.defineProperty(e, "__esModule", { value: !0 }),
          (e.scriptAdded = e.prefersReducedMotion = void 0);
        e.prefersReducedMotion = function () {
          return window.matchMedia("(prefers-reduced-motion: reduce)").matches;
        };
        e.scriptAdded = function (t) {
          return !!document.querySelector(t);
        };
      },
      4123: (t, e) => {
        Object.defineProperty(e, "__esModule", { value: !0 });
        var n = (function () {
          function t(t, e) {
            (this.closeFn = t),
              (this.shouldListen = e),
              (this.isListening = !1),
              (this.handleKeyDown = this.handleKeyDown.bind(this));
          }
          return (
            (t.prototype.handleKeyDown = function (t) {
              "Escape" === t.key &&
                this.shouldListen() &&
                (this.disable(), this.closeFn());
            }),
            (t.prototype.enable = function () {
              this.isListening ||
                (document.addEventListener("keydown", this.handleKeyDown),
                  (this.isListening = !0));
            }),
            (t.prototype.disable = function () {
              document.removeEventListener("keydown", this.handleKeyDown),
                (this.isListening = !1);
            }),
            t
          );
        })();
        e.default = n;
      },
      3050: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = n(5249),
          a = n(8251),
          s = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              if (!0 === n.alreadyInitialized) return n;
              (n.audio = n.container.querySelector("audio")),
                (n.playButton = n.container.querySelector(
                  ".m-audio__play-button"
                )),
                (n.pauseButton = n.container.querySelector(
                  ".m-audio__pause-button"
                ));
              var o = n.container.querySelector(".a-timeline");
              o &&
                (o.component
                  ? (n.timeline = o.component)
                  : (n.timeline = new a.default(o))),
                (n.volumeHighButton = n.container.querySelector(
                  ".m-audio__volume-high-button"
                )),
                (n.volumeDisabledButton = n.container.querySelector(
                  ".m-audio__volume-disabled-button"
                )),
                (n.volumeSlider = n.container.querySelector(
                  ".m-audio__volume-slider input"
                )),
                (n.transcriptButton = n.container.querySelector(
                  ".m-audio__transcript-button"
                )),
                (n.volumeControllersButton = n.container.querySelector(
                  ".m-audio__volume-controllers"
                )),
                (n.settingsControllersButton = n.container.querySelector(
                  ".m-audio__settings-controllers-button"
                )),
                (n.settingsFlyout = n.container.querySelector(
                  ".m-audio__settings-flyout"
                )),
                (n.downloadLink = n.container.querySelector(
                  ".m-audio__download-link"
                )),
                (n.playbackRateButton = n.container.querySelector(
                  ".m-audio__playback-rate-button"
                )),
                (n.playbackRateOptionsContainer = n.container.querySelector(
                  ".m-audio__playback-rate-options"
                )),
                (n.playbackRateGoBackButton = n.container.querySelector(
                  ".m-audio__playback-rate-go-back-button"
                )),
                (n.playbackRateButtons = n.container.querySelectorAll(
                  ".m-audio__playback-rate-option"
                )),
                n.audio.addEventListener(
                  "loadedmetadata",
                  n.handleAudioMetadata.bind(n)
                );
              var i = n.audio.getAttribute("data-src-url");
              if (void 0 === i)
                throw Error(
                  "Audio source not found: The audio source should be provided as a string in the data-src-url attribute of the audio element."
                );
              return (
                (n.audio.src = i),
                n.audio.addEventListener(
                  "timeupdate",
                  n.handleTimeUpdate.bind(n)
                ),
                n.playButton.addEventListener("click", function () {
                  return n.toggleAudioPlaybackAndFocus(!0);
                }),
                n.pauseButton.addEventListener("click", function () {
                  return n.toggleAudioPlaybackAndFocus(!1);
                }),
                n.timeline.addEventListener(
                  "onRangeChange",
                  n.handleTimelineRangeInput.bind(n)
                ),
                n.timeline.addEventListener(
                  "onMouseup",
                  n.handleTimelineRangeMouseUp.bind(n)
                ),
                n.timeline.addEventListener(
                  "onFocus",
                  n.hideVolumeSlider.bind(n)
                ),
                n.timeline.addEventListener(
                  "onKeyup",
                  n.handleTimelineRangeKeyUp.bind(n)
                ),
                n.volumeHighButton.addEventListener(
                  "click",
                  n.handleVolumeHigh.bind(n)
                ),
                n.volumeHighButton.addEventListener(
                  "focus",
                  n.showVolumeSlider.bind(n)
                ),
                n.volumeDisabledButton.addEventListener(
                  "focus",
                  n.showVolumeSlider.bind(n)
                ),
                n.volumeDisabledButton.addEventListener(
                  "click",
                  n.handleVolumeDisabled.bind(n)
                ),
                n.volumeControllersButton.addEventListener(
                  "mouseover",
                  n.handleVolumeOver.bind(n)
                ),
                n.volumeControllersButton.addEventListener(
                  "mouseout",
                  n.handleVolumeOut.bind(n)
                ),
                n.volumeSlider.addEventListener(
                  "input",
                  n.handleVolumeSlider.bind(n)
                ),
                n.volumeSlider.addEventListener(
                  "keydown",
                  n.handleVolumeSliderKeyDown.bind(n)
                ),
                n.transcriptButton.addEventListener(
                  "focus",
                  n.hideVolumeSlider.bind(n)
                ),
                n.settingsControllersButton &&
                (n.settingsControllersButton.addEventListener(
                  "click",
                  n.toggleSettingsFlyout.bind(n)
                ),
                  n.settingsControllersButton.addEventListener(
                    "focus",
                    n.hideVolumeSlider.bind(n)
                  )),
                n.playbackRateButton &&
                n.playbackRateButton.addEventListener(
                  "click",
                  n.handlePlaybackRateButtonClick.bind(n)
                ),
                n.playbackRateGoBackButton &&
                n.playbackRateGoBackButton.addEventListener(
                  "click",
                  n.handleGoBackButtonClick.bind(n)
                ),
                n.playbackRateButtons.forEach(function (t) {
                  n.handlePlaybackRateOptionClick(t);
                }),
                n.settingsFlyout &&
                n.settingsFlyout.addEventListener("keydown", function (t) {
                  n.keepFocusLastElement(t, n.settingsFlyout);
                }),
                n.playbackRateOptionsContainer &&
                n.playbackRateOptionsContainer.addEventListener(
                  "keydown",
                  function (t) {
                    n.keepFocusInContainer(t, n.playbackRateOptionsContainer);
                  }
                ),
                n.container.addEventListener(
                  "click",
                  n.handleDocumentClick.bind(n)
                ),
                (n.isAudioPlaying = !1),
                (n.isVolumeHovering = !1),
                (n.audio.volume = 0.5),
                (n.volumeSlider.valueAsNumber = 50),
                (n.activePlaybackRate = 1),
                n
              );
            }
            return (
              i(e, t),
              (e.prototype.formatTime = function (t) {
                var e = Math.floor(t / 60),
                  n = Math.floor(t % 60);
                return "".concat(e, ":").concat(n.toString().padStart(2, "0"));
              }),
              (e.prototype.handleTimeUpdate = function () {
                this.timeline.setCurrent(this.audio.currentTime);
              }),
              (e.prototype.handleAudioMetadata = function () {
                this.timeline.setDuration(this.audio.duration);
              }),
              (e.prototype.toggleAudioPlaybackAndFocus = function (t) {
                (this.isAudioPlaying = t),
                  t
                    ? (this.audio.play(),
                      this.playButton.classList.remove("-show"),
                      this.pauseButton.classList.add("-show"),
                      this.pauseButton.focus(),
                      this.playButton.setAttribute("aria-hidden", "false"),
                      this.pauseButton.setAttribute("aria-hidden", "true"),
                      this.timeline.setPlayingState(!0))
                    : (this.audio.pause(),
                      this.pauseButton.classList.remove("-show"),
                      this.playButton.classList.add("-show"),
                      this.playButton.focus(),
                      this.playButton.setAttribute("aria-hidden", "true"),
                      this.pauseButton.setAttribute("aria-hidden", "false"),
                      this.timeline.setPlayingState(!1)),
                  this.timeline.setCurrent(this.audio.currentTime);
              }),
              (e.prototype.updateVolumeSlider = function (t, e) {
                var n = t;
                (n.value = e.toString()),
                  n.setAttribute("value", n.value),
                  n.setAttribute("aria-valuenow", n.value),
                  n.style.setProperty("--slider-percentage", "".concat(e));
              }),
              (e.prototype.handleTimelineRangeInput = function (t) {
                this.audio.pause(), (this.audio.currentTime = t);
              }),
              (e.prototype.handleTimelineRangeMouseUp = function () {
                this.isAudioPlaying && this.audio.play();
              }),
              (e.prototype.handleVolumeHigh = function () {
                (this.audio.muted = !0),
                  this.volumeHighButton.classList.remove("-show"),
                  this.volumeDisabledButton.classList.add("-show"),
                  this.volumeDisabledButton.focus(),
                  this.volumeHighButton.setAttribute("aria-hidden", "false"),
                  this.volumeDisabledButton.setAttribute("aria-hidden", "true");
              }),
              (e.prototype.handleVolumeDisabled = function () {
                (this.audio.muted = !1),
                  this.volumeDisabledButton.classList.remove("-show"),
                  this.volumeHighButton.classList.add("-show"),
                  this.volumeHighButton.focus(),
                  this.volumeDisabledButton.setAttribute(
                    "aria-hidden",
                    "false"
                  ),
                  this.volumeHighButton.setAttribute("aria-hidden", "true");
              }),
              (e.prototype.handleVolumeOver = function () {
                (this.isVolumeHovering = !0),
                  this.settingsFlyout && this.hideSettingsFlyout(),
                  this.playbackRateOptionsContainer &&
                  this.hidePlaybackRateOptionsContainer(),
                  this.showVolumeSlider();
              }),
              (e.prototype.handleVolumeOut = function () {
                var t = this;
                (this.isVolumeHovering = !1),
                  setTimeout(function () {
                    t.isVolumeHovering || t.hideVolumeSlider();
                  }, 100);
              }),
              (e.prototype.handleVolumeSlider = function () {
                var t = this.volumeSlider.valueAsNumber / 100;
                (this.audio.volume = t),
                  0 === t
                    ? this.handleVolumeHigh()
                    : this.handleVolumeDisabled();
                var e = Math.floor(parseFloat(this.volumeSlider.value));
                this.updateVolumeSlider(this.volumeSlider, e);
              }),
              (e.prototype.handleVolumeSliderKeyDown = function (t) {
                if ("ArrowLeft" === t.key) {
                  t.preventDefault();
                  var e = parseFloat(this.volumeSlider.value),
                    n = Math.max(e - 1, parseFloat(this.volumeSlider.min));
                  (this.volumeSlider.valueAsNumber = n),
                    this.handleVolumeSlider(),
                    this.volumeSlider.focus();
                } else if ("ArrowRight" === t.key) {
                  t.preventDefault();
                  (e = parseFloat(this.volumeSlider.value)),
                    (n = Math.min(e + 1, parseFloat(this.volumeSlider.max)));
                  (this.volumeSlider.value = n.toString()),
                    this.handleVolumeSlider(),
                    this.volumeSlider.focus();
                }
              }),
              (e.prototype.handlePlaybackRateButtonClick = function (t) {
                t.stopPropagation(),
                  this.playbackRateOptionsContainer &&
                  this.showPlaybackRateOptionsContainer(),
                  this.hideSettingsFlyout();
              }),
              (e.prototype.handleGoBackButtonClick = function () {
                this.playbackRateOptionsContainer &&
                  this.hidePlaybackRateOptionsContainer(),
                  this.showSettingsFlyout(),
                  (this.downloadLink
                    ? this.downloadLink.querySelector("a")
                    : this.playbackRateButton
                  ).focus();
              }),
              (e.prototype.handlePlaybackRateOptionClick = function (t) {
                var e = this;
                t.addEventListener("click", function (n) {
                  n.stopPropagation();
                  var o = parseFloat(t.getAttribute("data-rate"));
                  if (o !== e.activePlaybackRate) {
                    var i = document.querySelector(
                      '[data-rate="'.concat(e.activePlaybackRate, '"]')
                    );
                    if (i) {
                      var r = i.querySelector(
                        ".m-audio__playback-rate-checkmark"
                      );
                      r && r.classList.remove("active-rate");
                    }
                    e.activePlaybackRate = o;
                    var a = t.querySelector(
                      ".m-audio__playback-rate-checkmark"
                    );
                    a && a.classList.add("active-rate"),
                      (e.audio.playbackRate = o),
                      e.hideSettingsFlyout(),
                      e.hidePlaybackRateOptionsContainer(),
                      e.settingsControllersButton.focus();
                  }
                });
              }),
              (e.prototype.handleDocumentClick = function (t) {
                var e = t.target;
                (this.settingsControllersButton &&
                  this.settingsControllersButton.contains(e)) ||
                  (this.settingsFlyout && this.settingsFlyout.contains(e)) ||
                  (this.playbackRateOptionsContainer &&
                    this.playbackRateOptionsContainer.contains(e)) ||
                  (this.settingsFlyout && this.hideSettingsFlyout(),
                    this.playbackRateOptionsContainer &&
                    this.hidePlaybackRateOptionsContainer());
              }),
              (e.prototype.showVolumeSlider = function () {
                this.settingsFlyout && this.hideSettingsFlyout(),
                  this.volumeSlider.parentElement.classList.add("-show");
              }),
              (e.prototype.hideVolumeSlider = function () {
                this.volumeSlider.parentElement.classList.remove("-show");
              }),
              (e.prototype.handleTimelineRangeKeyUp = function (t) {
                ("ArrowRight" !== t.key && "ArrowLeft" !== t.key) ||
                  this.handleTimelineRangeMouseUp();
              }),
              (e.prototype.toggleSettingsFlyout = function () {
                this.settingsFlyout.classList.contains("-show")
                  ? this.hideSettingsFlyout()
                  : this.showSettingsFlyout();
              }),
              (e.prototype.showSettingsFlyout = function () {
                this.settingsFlyout.classList.add("-show"),
                  this.hideVolumeSlider();
              }),
              (e.prototype.hideSettingsFlyout = function () {
                this.settingsFlyout.classList.remove("-show");
              }),
              (e.prototype.showPlaybackRateOptionsContainer = function () {
                this.playbackRateOptionsContainer.classList.add("-show"),
                  this.playbackRateGoBackButton.focus();
              }),
              (e.prototype.hidePlaybackRateOptionsContainer = function () {
                this.playbackRateOptionsContainer.classList.remove("-show");
              }),
              (e.prototype.keepFocusLastElement = function (t, e) {
                var n = Array.from(e.querySelectorAll("button, a"));
                if ("Tab" === t.key) {
                  var o = n[n.length - 1];
                  t.shiftKey ||
                    document.activeElement !== o ||
                    (t.preventDefault(), e.focus());
                }
              }),
              (e.prototype.keepFocusInContainer = function (t, e) {
                var n = Array.from(e.querySelectorAll("button, a"));
                if ("Tab" === t.key) {
                  var o = n[0],
                    i = n[n.length - 1];
                  t.shiftKey
                    ? document.activeElement === o &&
                    (t.preventDefault(), o.focus())
                    : document.activeElement === i &&
                    (t.preventDefault(), i.focus());
                }
              }),
              e
            );
          })(r.default);
        e.default = s;
      },
      349: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = (function (t) {
          function e(e) {
            var n = t.call(this, e) || this;
            return (
              e.classList.contains("-non-modal") &&
              e.addEventListener("click", function (t) {
                var n = e.getBoundingClientRect();
                (t.clientX < n.left ||
                  t.clientX > n.right ||
                  t.clientY < n.top ||
                  t.clientY > n.bottom) &&
                  e.close();
              }),
              (n.confirmButtons = Array.from(
                e.querySelectorAll('[data-frok-action="confirm"]')
              )),
              (n.closeButtons = Array.from(
                e.querySelectorAll('[data-frok-action="close"]')
              )),
              (n.cancelButtons = Array.from(
                e.querySelectorAll('[data-frok-action="cancel"]')
              )),
              n.confirmButtons &&
              n.confirmButtons.forEach(function (t) {
                t.addEventListener("click", function () {
                  e.close();
                });
              }),
              n.closeButtons &&
              n.closeButtons.forEach(function (t) {
                t.addEventListener("click", function () {
                  e.close();
                });
              }),
              n.cancelButtons &&
              n.cancelButtons.forEach(function (t) {
                t.addEventListener("click", function () {
                  e.close();
                });
              }),
              n
            );
          }
          return i(e, t), e;
        })(n(5249).default);
        e.default = r;
      },
      1270: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r,
          a = n(5249);
        !(function (t) {
          (t.success = "success"),
            (t.error = "error"),
            (t.warning = "warning"),
            (t.neutral = "neutral");
        })(r || (r = {}));
        var s = [r.success, r.error, r.warning, r.neutral],
          c = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              return (
                (n.field = e.querySelector(
                  ".a-text-field, .a-email-input, .a-password-input, .a-telephone-input, .a-text-area, .a-radio-button, .a-checkbox, .a-dropdown, .a-toggle, .a-value-modificator, .a-date-input"
                )),
                (n.input = n.field.querySelector("input, textarea")),
                n
              );
            }
            return (
              i(e, t),
              (e.prototype.setState = function (t, e) {
                var n = this;
                s.includes(t)
                  ? (s.forEach(function (t) {
                    return n.field.classList.remove("-".concat(t));
                  }),
                    this.field.classList.add("-".concat(t)),
                    e ? this.setNotification(e) : this.clearNotification())
                  : console.warn(
                    "Unknown state ".concat(t, " for a FormField - ignoring.")
                  );
              }),
              (e.prototype.clearNotification = function () {
                this.notification && this.notification.remove();
              }),
              (e.prototype.setNotification = function (t) {
                var e, n;
                this.clearNotification(),
                  (this.notification =
                    ((e = (function (t, e) {
                      return '\n    <div class="a-notification a-notification--text -'
                        .concat(e || "neutral", '">\n        ')
                        .concat(
                          e &&
                          '<i class="a-icon ui-ic-alert-'.concat(
                            e,
                            '" title="Loren Ipsum"></i>'
                          ),
                          '\n        <div class="a-notification__content">\n            '
                        )
                        .concat(t, "\n        </div>\n    </div>\n");
                    })(t, this.getState())),
                      ((n = document.createElement("div")).innerHTML = e.trim()),
                      n.firstChild)),
                  this.container.appendChild(this.notification);
              }),
              (e.prototype.getState = function () {
                var t = this,
                  e = s.filter(function (e) {
                    return t.field.classList.contains("-".concat(e));
                  });
                return 0 === e.length ? r.neutral : e[0];
              }),
              e
            );
          })(a.default);
        e.default = c;
      },
      3698: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = n(5249),
          a = n(5038),
          s = n(4123),
          c = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              (n.currentIndex = 0),
                (n.next = function (t) {
                  t + 1 !== n.images.length
                    ? (n.currentIndex = t + 1)
                    : (n.currentIndex = 0),
                    n.toggleCaption(!0),
                    n.toggleExpandButton(!0),
                    n.setActiveImage(),
                    n.setLongCaptionClass();
                }),
                (n.back = function (t) {
                  (n.currentIndex = 0 !== t ? t - 1 : n.images.length - 1),
                    n.toggleCaption(!0),
                    n.toggleExpandButton(!0),
                    n.setActiveImage(),
                    n.setLongCaptionClass();
                }),
                (n.extended = !1),
                (n.sequence = !1),
                (n.isOpen = !1),
                (n.isMobile = window.outerWidth < 768),
                n.container.classList.contains("-extended") &&
                (n.extended = !0),
                n.container.classList.contains("m-lightbox--sequence") &&
                (n.sequence = !0),
                window.addEventListener("resize", function () {
                  (n.isMobile = window.outerWidth < 768),
                    n.isOpen &&
                    n.extended &&
                    (n.toggleCaption(!0),
                      n.toggleExpandButton(!0),
                      n.isCaptionToLong()
                        ? n.container.classList.add("-long-caption")
                        : n.container.classList.remove("-long-caption"));
                }),
                (n.wrapper = e.querySelector(".m-lightbox__wrapper")),
                (n.images = e.querySelectorAll(".a-image")),
                (n.counter = e.querySelector(".m-lightbox__counter")),
                (n.closeButton = e.querySelector('[data-frok-action="close"]')),
                (n.nextButton = e.querySelector('[data-frok-action="right"]')),
                (n.backButton = e.querySelector('[data-frok-action="left"]')),
                (n.expandButton = e.querySelector(
                  '[data-frok-action="expand"]'
                ));
              var o = e.querySelector(".a-box, .a-box--modal");
              if (
                (n.setActiveImage(),
                  n.nextButton instanceof HTMLElement &&
                  n.sequence &&
                  n.nextButton.addEventListener("click", function () {
                    n.triggerEvent("next", n.currentIndex);
                  }),
                  n.backButton instanceof HTMLElement &&
                  n.sequence &&
                  n.backButton.addEventListener("click", function () {
                    n.triggerEvent("back", n.currentIndex);
                  }),
                  n.closeButton instanceof HTMLElement &&
                  n.closeButton.addEventListener("click", function () {
                    n.triggerEvent("closeClicked");
                  }),
                  n.expandButton instanceof HTMLElement &&
                  n.extended &&
                  n.expandButton.addEventListener("click", function () {
                    n.toggleCaption(), n.toggleExpandButton();
                  }),
                  !o)
              )
                throw new Error(
                  "Dialog is missing a box, please check your dialog markup"
                );
              return (
                (n.box = new a.default(o)),
                n.box.isModal() &&
                (document.body.appendChild(e), e.appendChild(o)),
                n.wrapper.addEventListener("click", function (t) {
                  t.target === n.wrapper && n.triggerEvent("backgroundClicked");
                }),
                (n.escapeKeyHandler = new s.default(
                  n.hide.bind(n),
                  function () {
                    return n.isOpen;
                  }
                )),
                n
              );
            }
            return (
              i(e, t),
              (e.prototype.show = function () {
                this.box.show(),
                  (this.isOpen = !0),
                  this.escapeKeyHandler.enable(),
                  this.setLongCaptionClass();
              }),
              (e.prototype.hide = function () {
                this.box.hide(),
                  (this.isOpen = !1),
                  this.escapeKeyHandler.disable(),
                  this.container.classList.remove("-long-caption"),
                  this.toggleCaption(!0),
                  this.toggleExpandButton(!0),
                  (this.currentIndex = 0),
                  this.setActiveImage();
              }),
              (e.prototype.isCaptionToLong = function () {
                var t =
                  this.images[this.currentIndex].querySelector("figcaption");
                return this.isMobile
                  ? t.scrollHeight >=
                  this.wrapper.clientHeight -
                  48 -
                  48 -
                  this.images[this.currentIndex].clientHeight
                  : t.clientHeight < t.scrollHeight;
              }),
              (e.prototype.toggleCaption = function (t) {
                var e =
                  this.images[this.currentIndex].querySelector("figcaption");
                e instanceof HTMLElement &&
                  (e.classList.toggle("-open"),
                    t && e.classList.remove("-open"));
              }),
              (e.prototype.toggleExpandButton = function (t) {
                this.expandButton instanceof HTMLElement &&
                  (this.expandButton.classList.toggle("-open"),
                    t && this.expandButton.classList.remove("-open"));
              }),
              (e.prototype.setLongCaptionClass = function () {
                this.extended && this.isCaptionToLong()
                  ? this.container.classList.add("-long-caption")
                  : this.extended &&
                  !this.isCaptionToLong() &&
                  this.container.classList.remove("-long-caption");
              }),
              (e.prototype.setActiveImage = function () {
                var t = this;
                this.images.forEach(function (e, n) {
                  n === t.currentIndex
                    ? e.classList.add("-active")
                    : e.classList.remove("-active");
                }),
                  this.counter instanceof HTMLElement &&
                  (this.counter.innerHTML = ""
                    .concat(this.currentIndex + 1, " / ")
                    .concat(this.images.length));
              }),
              (e.events = [
                "closeClicked",
                "next",
                "back",
                "backgroundClicked",
              ]),
              (e.lightboxId = function (t) {
                return "frontend-kit-lightbox-".concat(t);
              }),
              (e.findLightbox = function (t, n) {
                return (
                  void 0 === n &&
                  (n = function (t) {
                    return window.document.getElementById(e.lightboxId(t));
                  }),
                  n(t)
                );
              }),
              (e.showLightbox = function (t) {
                var n = e.findLightbox(t);
                n
                  ? n.component.show()
                  : console.warn(
                    "Could not find a lightbox with id ".concat(
                      t,
                      " to show."
                    )
                  );
              }),
              (e.hideLightbox = function (t) {
                var n = e.findLightbox(t);
                n
                  ? n.component.hide()
                  : console.warn(
                    "Could not find a lightbox with id ".concat(
                      t,
                      " to hide."
                    )
                  );
              }),
              e
            );
          })(r.default);
        e.default = c;
      },
      8336: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 }),
          (e.ON_FLYOUT_CLOSE = e.ON_FLYOUT_OPEN = void 0);
        var r = n(5249),
          a =
            'li:not(.-disabled) > .a-menu-item__wrapper > [class^="a-menu-item"]';
        (e.ON_FLYOUT_OPEN = "onFlyoutOpen"),
          (e.ON_FLYOUT_CLOSE = "onFlyoutClose");
        var s = (function (t) {
          function n(n) {
            var o = t.call(this, n) || this;
            return (
              !0 === o.alreadyInitialized ||
              ((o.firstMenuItem = n.querySelector(
                ".m-menu-group > .a-menu-item > .a-menu-item__wrapper > *"
              )),
                (o.firstLevelItems = Array.from(
                  n.querySelectorAll(
                    ".m-menu-group > .a-menu-item:not(.-disabled)"
                  )
                )),
                (o.groupTriggers = Array.from(
                  n.querySelectorAll(
                    ".a-menu-item:not(.-disabled):has(.a-menu-item__group)"
                  )
                )),
                (o.groups = Array.from(
                  n.querySelectorAll(".m-menu-group__group")
                )),
                (o.flyoutTriggers = Array.from(
                  n.querySelectorAll(
                    ".a-menu-item:not(.-disabled):has(.a-menu-item__side-menu)"
                  )
                )),
                (o.flyouts = Array.from(
                  n.querySelectorAll(".m-menu-group__flyout")
                )),
                o.container.addEventListener("keydown", function (t) {
                  if ("Escape" === t.code) {
                    var i = n.querySelector(
                      ".a-menu-item.-open:has(> .m-menu-group__flyout)"
                    );
                    if (i) i.querySelector("[type=button]").focus();
                    o.closeFlyouts(), o.triggerEvent(e.ON_FLYOUT_CLOSE);
                  }
                }),
                o.groupTriggers.forEach(function (t) {
                  var e = t.querySelector(".a-menu-item__group"),
                    n = t.querySelector(".m-menu-group__group");
                  e.addEventListener("click", function () {
                    t.classList.contains("-open")
                      ? (n.querySelectorAll(a).forEach(function (t) {
                        t.setAttribute("tabIndex", "-1");
                      }),
                        t.classList.remove("-open"),
                        (n.ariaExpanded = "false"))
                      : (o.closeGroups(),
                        t.classList.add("-open"),
                        n.querySelectorAll(a).forEach(function (t) {
                          return t.removeAttribute("tabIndex");
                        }),
                        n.setAttribute("aria-expanded", "true"));
                  });
                }),
                o.flyoutTriggers.forEach(function (t) {
                  var n = t.querySelector(".a-menu-item__side-menu"),
                    i = t.querySelector(".m-menu-group__flyout");
                  n.addEventListener("keydown", function (n) {
                    ("Enter" !== n.code && "Space" !== n.code) ||
                      (n.preventDefault(),
                        t.classList.contains("-open")
                          ? (i.querySelectorAll(a).forEach(function (t) {
                            t.setAttribute("tabIndex", "-1");
                          }),
                            t.classList.remove("-open"),
                            i.setAttribute("aria-expanded", "false"))
                          : (o.closeFlyouts(),
                            t.classList.add("-open"),
                            i.querySelectorAll(a).forEach(function (t) {
                              return t.removeAttribute("tabIndex");
                            }),
                            i.setAttribute("aria-expanded", "true"),
                            o.triggerEvent(e.ON_FLYOUT_OPEN)));
                  }),
                    n.addEventListener("click", function (n) {
                      n.preventDefault(),
                        o.closeFlyouts(),
                        t.classList.add("-open"),
                        i.querySelectorAll(a).forEach(function (t) {
                          return t.removeAttribute("tabIndex");
                        }),
                        i.setAttribute("aria-expanded", "true"),
                        o.triggerEvent(e.ON_FLYOUT_OPEN);
                    });
                }),
                o.firstLevelItems.forEach(function (t) {
                  var n = t.querySelector(".a-menu-item__side-menu"),
                    i = t.querySelector(".m-menu-group__flyout");
                  t.addEventListener("mouseenter", function () {
                    o.closeFlyouts(),
                      n &&
                      i &&
                      (t.classList.add("-open"),
                        i.querySelectorAll(a).forEach(function (t) {
                          return t.removeAttribute("tabIndex");
                        }),
                        i.setAttribute("aria-expanded", "true"),
                        o.triggerEvent(e.ON_FLYOUT_OPEN));
                  });
                })),
              o
            );
          }
          return (
            i(n, t),
            (n.prototype.enableMenus = function () {
              this.firstLevelItems.forEach(function (t) {
                t.querySelector(
                  ".a-menu-item .a-menu-item__wrapper > *"
                ).setAttribute("tabindex", "0");
              });
            }),
            (n.prototype.disableMenus = function () {
              this.firstLevelItems.forEach(function (t) {
                t.querySelector(
                  ".a-menu-item .a-menu-item__wrapper > *"
                ).setAttribute("tabindex", "-1");
              });
            }),
            (n.prototype.focusFirstMenuItem = function () {
              this.firstMenuItem.focus();
            }),
            (n.prototype.closeGroups = function () {
              this.groupTriggers.forEach(function (t) {
                t.classList.remove("-open"),
                  t
                    .querySelector(".m-menu-group__group")
                    .querySelectorAll(a)
                    .forEach(function (t) {
                      t.setAttribute("tabIndex", "-1");
                    });
              }),
                this.groups.forEach(function (t) {
                  t.ariaExpanded = "false";
                });
            }),
            (n.prototype.closeFlyouts = function () {
              this.flyoutTriggers.forEach(function (t) {
                t.classList.remove("-open"),
                  t
                    .querySelector(".m-menu-group__flyout")
                    .querySelectorAll(a)
                    .forEach(function (t) {
                      t.setAttribute("tabIndex", "-1");
                    });
              }),
                this.flyouts.forEach(function (t) {
                  t.ariaExpanded = "false";
                });
            }),
            (n.events = [e.ON_FLYOUT_OPEN, e.ON_FLYOUT_CLOSE]),
            n
          );
        })(r.default);
        e.default = s;
      },
      4222: (t, e) => {
        var n;
        Object.defineProperty(e, "__esModule", { value: !0 }),
          (e.arrowPositions = e.arrowClasses = e.ArrowPosition = void 0),
          (function (t) {
            (t.TOP_LEFT = "top-left"),
              (t.TOP_CENTER = "top-center"),
              (t.TOP_RIGHT = "top-right"),
              (t.LEFT_TOP = "left-top"),
              (t.LEFT_CENTER = "left-center"),
              (t.LEFT_BOTTOM = "left-bottom"),
              (t.BOTTOM_LEFT = "bottom-left"),
              (t.BOTTOM_CENTER = "bottom-center"),
              (t.BOTTOM_RIGHT = "bottom-right"),
              (t.RIGHT_BOTTOM = "right-bottom"),
              (t.RIGHT_CENTER = "right-center"),
              (t.RIGHT_TOP = "right-top");
          })(n || (n = {})),
          (e.ArrowPosition = n);
        var o = [
          n.TOP_LEFT,
          n.TOP_CENTER,
          n.TOP_RIGHT,
          n.LEFT_TOP,
          n.LEFT_CENTER,
          n.LEFT_BOTTOM,
          n.BOTTOM_LEFT,
          n.BOTTOM_CENTER,
          n.BOTTOM_RIGHT,
          n.RIGHT_BOTTOM,
          n.RIGHT_CENTER,
          n.RIGHT_TOP,
        ];
        e.arrowPositions = o;
        var i = o.map(function (t) {
          return "-".concat(t);
        });
        e.arrowClasses = i;
      },
      2063: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              }),
          r =
            (this && this.__assign) ||
            function () {
              return (r =
                Object.assign ||
                function (t) {
                  for (var e, n = 1, o = arguments.length; n < o; n++)
                    for (var i in (e = arguments[n]))
                      Object.prototype.hasOwnProperty.call(e, i) &&
                        (t[i] = e[i]);
                  return t;
                }).apply(this, arguments);
            };
        Object.defineProperty(e, "__esModule", { value: !0 });
        var a = n(5249),
          s = n(4123),
          c = n(4222),
          u = function (t) {
            var e = t.getBoundingClientRect();
            return r(r({}, e), {
              left: e.left + window.pageXOffset,
              top: e.top + window.pageYOffset,
              bottom: e.bottom + window.pageYOffset,
              right: e.right + window.pageXOffset,
            });
          },
          l = function (t) {
            var e = c.arrowClasses.filter(function (e) {
              return t.classList.contains(e);
            });
            return 0 === e.length ? "top-center" : e[0].substring(1);
          },
          d = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              n.escapeKeyHelper = new s.default(
                n.hide.bind(n),
                n.isOpen.bind(n)
              );
              var o = e.querySelector(".a-button--integrated"),
                i = e.querySelector(".a-button:not(.a-button--integrated)");
              return (
                i &&
                i.addEventListener("click", function () {
                  return n.triggerEvent("buttonClicked");
                }),
                o &&
                o.addEventListener("click", function () {
                  return n.triggerEvent("closeButtonClicked");
                }),
                window.addEventListener("resize", function () {
                  return n.hide();
                }),
                n
              );
            }
            return (
              i(e, t),
              (e.prototype.attach = function (t, e) {
                return (
                  void 0 === e && (e = document.body),
                  e.appendChild(this.container),
                  this.container.classList.remove("-detached"),
                  (this.attachedTo = t),
                  (this.attachmentContainer = e),
                  this.recalculatePosition(),
                  this
                );
              }),
              (e.prototype.recalculatePosition = function () {
                if (this.attachedTo) {
                  var t = u(this.attachedTo),
                    e = l(this.container);
                  (this.container.style.left = "-9999px"),
                    (this.container.style.display = "block");
                  var n = this.container.getBoundingClientRect(),
                    o = u(this.attachmentContainer),
                    i = (function (t, e) {
                      switch (e) {
                        case c.ArrowPosition.RIGHT_CENTER:
                        case c.ArrowPosition.RIGHT_TOP:
                        case c.ArrowPosition.RIGHT_BOTTOM:
                          return {
                            left: t.left,
                            top: t.top + (t.bottom - t.top) / 2,
                          };
                        case c.ArrowPosition.LEFT_CENTER:
                        case c.ArrowPosition.LEFT_TOP:
                        case c.ArrowPosition.LEFT_BOTTOM:
                          return {
                            left: t.right,
                            top: t.top + (t.bottom - t.top) / 2,
                          };
                        case c.ArrowPosition.BOTTOM_CENTER:
                        case c.ArrowPosition.BOTTOM_LEFT:
                        case c.ArrowPosition.BOTTOM_RIGHT:
                          return {
                            left: t.left + (t.right - t.left) / 2,
                            top: t.top,
                          };
                        case c.ArrowPosition.TOP_CENTER:
                        case c.ArrowPosition.TOP_LEFT:
                        case c.ArrowPosition.TOP_RIGHT:
                        default:
                          return {
                            left: t.left + (t.right - t.left) / 2,
                            top: t.bottom,
                          };
                      }
                    })(t, e),
                    r = (function (t, e) {
                      return {
                        left: (function () {
                          switch (e) {
                            case c.ArrowPosition.BOTTOM_RIGHT:
                            case c.ArrowPosition.TOP_RIGHT:
                            case c.ArrowPosition.RIGHT_TOP:
                            case c.ArrowPosition.RIGHT_CENTER:
                            case c.ArrowPosition.RIGHT_BOTTOM:
                              return t.right - t.left;
                            case c.ArrowPosition.BOTTOM_LEFT:
                            case c.ArrowPosition.TOP_LEFT:
                            case c.ArrowPosition.LEFT_TOP:
                            case c.ArrowPosition.LEFT_CENTER:
                            case c.ArrowPosition.LEFT_BOTTOM:
                              return 0;
                            case c.ArrowPosition.BOTTOM_CENTER:
                            case c.ArrowPosition.TOP_CENTER:
                            default:
                              return (t.right - t.left) / 2;
                          }
                        })(),
                        top: (function () {
                          switch (e) {
                            case c.ArrowPosition.LEFT_CENTER:
                            case c.ArrowPosition.RIGHT_CENTER:
                              return (t.bottom - t.top) / 2;
                            case c.ArrowPosition.LEFT_BOTTOM:
                            case c.ArrowPosition.RIGHT_BOTTOM:
                            case c.ArrowPosition.BOTTOM_LEFT:
                            case c.ArrowPosition.BOTTOM_RIGHT:
                            case c.ArrowPosition.BOTTOM_CENTER:
                              return t.bottom - t.top;
                            case c.ArrowPosition.LEFT_TOP:
                            case c.ArrowPosition.RIGHT_TOP:
                            case c.ArrowPosition.TOP_LEFT:
                            case c.ArrowPosition.TOP_RIGHT:
                            case c.ArrowPosition.TOP_CENTER:
                            default:
                              return 0;
                          }
                        })(),
                      };
                    })(n, e),
                    a = (function (t) {
                      return {
                        left: (function () {
                          switch (t) {
                            case c.ArrowPosition.RIGHT_TOP:
                            case c.ArrowPosition.RIGHT_CENTER:
                            case c.ArrowPosition.RIGHT_BOTTOM:
                              return "- 1rem";
                            case c.ArrowPosition.LEFT_TOP:
                            case c.ArrowPosition.LEFT_CENTER:
                            case c.ArrowPosition.LEFT_BOTTOM:
                              return "+ 1rem";
                            case c.ArrowPosition.TOP_RIGHT:
                            case c.ArrowPosition.BOTTOM_RIGHT:
                              return "+ 24px";
                            case c.ArrowPosition.TOP_LEFT:
                            case c.ArrowPosition.BOTTOM_LEFT:
                              return "- 24px";
                            case c.ArrowPosition.TOP_CENTER:
                            case c.ArrowPosition.BOTTOM_CENTER:
                            default:
                              return "0";
                          }
                        })(),
                        top: (function () {
                          switch (t) {
                            case c.ArrowPosition.RIGHT_TOP:
                            case c.ArrowPosition.LEFT_TOP:
                              return "- 24px";
                            case c.ArrowPosition.RIGHT_CENTER:
                            case c.ArrowPosition.LEFT_CENTER:
                              return "0";
                            case c.ArrowPosition.RIGHT_BOTTOM:
                            case c.ArrowPosition.LEFT_BOTTOM:
                              return "+ 24px";
                            case c.ArrowPosition.BOTTOM_RIGHT:
                            case c.ArrowPosition.BOTTOM_CENTER:
                            case c.ArrowPosition.BOTTOM_LEFT:
                              return "- 1rem";
                            case c.ArrowPosition.TOP_RIGHT:
                            case c.ArrowPosition.TOP_CENTER:
                            case c.ArrowPosition.TOP_LEFT:
                            default:
                              return "+ 1rem";
                          }
                        })(),
                      };
                    })(e),
                    s = "".concat(i.left - o.left - r.left, "px"),
                    d =
                      "0" === a.left
                        ? s
                        : "calc(".concat(s, " ").concat(a.left, ")");
                  this.container.style.left = d;
                  var p = "".concat(i.top - o.top - r.top, "px"),
                    h =
                      "0" === a.top
                        ? p
                        : "calc(".concat(p, " ").concat(a.top, ")");
                  (this.container.style.top = h),
                    (this.container.style.display = "");
                }
              }),
              (e.prototype.show = function () {
                this.recalculatePosition(),
                  this.container.classList.add("-show"),
                  this.escapeKeyHelper.enable();
              }),
              (e.prototype.hide = function () {
                this.container.classList.remove("-show"),
                  this.escapeKeyHelper.disable();
              }),
              (e.prototype.setPosition = function (t) {
                this.container.classList.remove("-".concat(l(this.container))),
                  this.container.classList.add("-".concat(t)),
                  this.recalculatePosition();
              }),
              (e.prototype.isOpen = function () {
                return this.container.classList.contains("-show");
              }),
              (e.events = ["buttonClicked", "closeButtonClicked"]),
              e
            );
          })(a.default);
        e.default = d;
      },
      1319: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = n(5249),
          a = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              return (
                (n.searchInputComponent =
                  n.container.querySelector(".a-search-input")),
                (n.searchInput = n.container.querySelector(
                  ".m-search-bar input"
                )),
                (n.searchButton = n.container.querySelector(
                  ".m-search-bar__icon-search"
                )),
                n.searchButton &&
                !n.searchInput.hasAttribute("readonly") &&
                n.searchButton.addEventListener("click", function () {
                  n.searchInputComponent.component.resetInputAndHideButton();
                }),
                n
              );
            }
            return i(e, t), e;
          })(r.default);
        e.default = a;
      },
      7045: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 }),
          (e.EVENT_SEARCH_CLOSE = e.EVENT_SEARCH_CLEAR = void 0);
        var r = n(4194),
          a = n(5249),
          s = n(4123);
        (e.EVENT_SEARCH_CLEAR = "searchClear"),
          (e.EVENT_SEARCH_CLOSE = "searchClose");
        var c = (function (t) {
          function n(e, n) {
            void 0 === n &&
              (n = function () {
                return !0;
              });
            var o = t.call(this, e) || this;
            (o.container = e), (o.element = e);
            var i = o.container.querySelector(".a-search-input");
            if (
              (i &&
                (i.component
                  ? (o.searchInput = i.component)
                  : (o.searchInput = new r.default(i))),
                (o.shouldListen = n),
                !o.searchInput)
            )
              throw new Error(
                "No SearchInput has been found for SearchFrom-Component"
              );
            return o.initKeyHelper(), o.initSearchInput(), o;
          }
          return (
            i(n, t),
            (n.prototype.enableListeners = function () {
              this.escapeKeyHelper.enable();
            }),
            (n.prototype.disableListeners = function () {
              this.escapeKeyHelper.disable();
            }),
            (n.prototype.initSearchInput = function () {
              var t = this;
              this.searchInput.addEventListener(r.EVENT_ON_INPUT, function (e) {
                e.length > 0 &&
                  !t.escapeKeyHelper.isListening &&
                  t.enableListeners();
              });
            }),
            (n.prototype.initKeyHelper = function () {
              var t = this;
              this.escapeKeyHelper = new s.default(function () {
                0 !== t.searchInput.getInputLength()
                  ? (t.searchInput.resetInputAndHideButton(),
                    t.searchInput.focusInput(),
                    t.triggerEvent(e.EVENT_SEARCH_CLEAR))
                  : t.triggerEvent(e.EVENT_SEARCH_CLOSE);
              }, this.shouldListen);
            }),
            (n.events = [e.EVENT_SEARCH_CLEAR, e.EVENT_SEARCH_CLOSE]),
            n
          );
        })(a.default);
        e.default = c;
      },
      9065: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = n(5249),
          a = n(6536),
          s = n(8336),
          c = function (t) {
            var e = function () {
              t.classList.add("-open"),
                t.classList.remove("-opening"),
                t.removeEventListener("transitionend", e);
            };
            t.addEventListener("transitionend", e);
          },
          u = (function (t) {
            function e(e, n) {
              var o = t.call(this, e) || this;
              if (!0 === o.alreadyInitialized) return o;
              n && (o.externalTrigger = n),
                (o.sideMenuTriggerOpen = e.querySelector(
                  ".m-side-navigation__header__trigger.-open"
                )),
                (o.sideMenuTriggerClose = e.querySelector(
                  ".m-side-navigation__header__trigger.-close"
                )),
                (o.menuItems = Array.from(
                  e.querySelectorAll(
                    ".m-menu-group > .a-menu-item:not(.-disabled)"
                  )
                ));
              var i = e.querySelector(".m-menu-group");
              return (
                i && (o.menuGroup = new s.default(i)),
                o.sideMenuTriggerOpen.addEventListener("click", function () {
                  e.classList.add("-opening"),
                    c(o.container),
                    o.sideMenuTriggerOpen.setAttribute("tabindex", "-1"),
                    o.sideMenuTriggerClose.setAttribute("tabindex", "0"),
                    o.menuGroup.focusFirstMenuItem();
                }),
                o.sideMenuTriggerClose.addEventListener("click", function () {
                  e.classList.remove("-open"),
                    e.classList.remove("-opening"),
                    o.sideMenuTriggerOpen.setAttribute("tabindex", "0"),
                    o.sideMenuTriggerClose.setAttribute("tabindex", "-1"),
                    o.sideMenuTriggerOpen.focus(),
                    o.menuGroup.closeGroups(),
                    window.matchMedia(a.default.DESKTOP_AND_UP).matches ||
                    (o.menuGroup.disableMenus(),
                      o.disableTrigger(),
                      o.disableNavigation(),
                      o.externalTrigger.focus());
                }),
                o.menuItems.forEach(function (t) {
                  t.addEventListener("click", function (t) {
                    e.classList.contains("-open") ||
                      (t.preventDefault(),
                        e.classList.add("-opening"),
                        c(o.container),
                        o.sideMenuTriggerOpen.setAttribute("tabindex", "-1"),
                        o.sideMenuTriggerClose.setAttribute("tabindex", "0"));
                  });
                }),
                window.addEventListener("resize", function () {
                  window.matchMedia(a.default.DESKTOP_AND_UP).matches
                    ? (o.menuGroup.enableMenus(),
                      o.enableTrigger(),
                      o.enableNavigation())
                    : o.container.classList.contains("-open") ||
                    (o.menuGroup.disableMenus(),
                      o.disableTrigger(),
                      o.disableNavigation());
                }),
                window.matchMedia(a.default.DESKTOP_AND_UP).matches ||
                o.container.classList.contains("-open") ||
                (o.menuGroup.disableMenus(),
                  o.disableTrigger(),
                  o.disableNavigation()),
                o
              );
            }
            return (
              i(e, t),
              (e.prototype.show = function () {
                this.container.classList.contains("-open") ||
                  this.container.classList.contains("-opening") ||
                  (c(this.container),
                    this.container.classList.add("-opening"),
                    this.enableTrigger(),
                    this.menuGroup.enableMenus(),
                    this.menuGroup.focusFirstMenuItem());
              }),
              (e.prototype.enableTrigger = function () {
                this.container.classList.contains("-open") ||
                  this.container.classList.contains("-opening")
                  ? (this.sideMenuTriggerOpen.setAttribute("tabindex", "-1"),
                    this.sideMenuTriggerClose.setAttribute("tabindex", "0"))
                  : (this.sideMenuTriggerOpen.setAttribute("tabindex", "0"),
                    this.sideMenuTriggerClose.setAttribute("tabindex", "-1"));
              }),
              (e.prototype.disableTrigger = function () {
                this.sideMenuTriggerOpen.setAttribute("tabindex", "-1"),
                  this.sideMenuTriggerClose.setAttribute("tabindex", "-1");
              }),
              (e.prototype.enableNavigation = function () {
                this.container.setAttribute("tabindex", "-1");
              }),
              (e.prototype.disableNavigation = function () {
                this.container.setAttribute("tabindex", "-1");
              }),
              (e.prototype.setExternalTrigger = function (t) {
                this.externalTrigger = t;
              }),
              e
            );
          })(r.default);
        e.default = u;
      },
      7779: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = n(5249),
          a = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              return (
                (n.uploadField = e.querySelector(".m-upload-area__field")),
                (n.uploadInput = e.querySelector(".m-upload-area__input")),
                n.uploadField.addEventListener(
                  "dragenter",
                  function (t) {
                    t.stopPropagation(), t.preventDefault();
                  },
                  !1
                ),
                n.uploadField.addEventListener(
                  "dragover",
                  function (t) {
                    t.stopPropagation(), t.preventDefault();
                  },
                  !1
                ),
                n.uploadField.addEventListener(
                  "drop",
                  function (t) {
                    t.stopPropagation(), t.preventDefault();
                    var e = t.dataTransfer,
                      o = Array.from(e.files),
                      i = new CustomEvent("filesAdded", {
                        detail: { files: o },
                      });
                    n.uploadInput.dispatchEvent(i);
                  },
                  !1
                ),
                n.uploadInput.addEventListener("change", function () {
                  var t = Array.from(n.uploadInput.files),
                    e = new CustomEvent("filesAdded", { detail: { files: t } });
                  n.uploadInput.dispatchEvent(e);
                }),
                n
              );
            }
            return i(e, t), e;
          })(r.default);
        e.default = a;
      },
      2594: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              }),
          r =
            (this && this.__awaiter) ||
            function (t, e, n, o) {
              return new (n || (n = Promise))(function (i, r) {
                function a(t) {
                  try {
                    c(o.next(t));
                  } catch (t) {
                    r(t);
                  }
                }
                function s(t) {
                  try {
                    c(o.throw(t));
                  } catch (t) {
                    r(t);
                  }
                }
                function c(t) {
                  var e;
                  t.done
                    ? i(t.value)
                    : ((e = t.value),
                      e instanceof n
                        ? e
                        : new n(function (t) {
                          t(e);
                        })).then(a, s);
                }
                c((o = o.apply(t, e || [])).next());
              });
            },
          a =
            (this && this.__generator) ||
            function (t, e) {
              var n,
                o,
                i,
                r,
                a = {
                  label: 0,
                  sent: function () {
                    if (1 & i[0]) throw i[1];
                    return i[1];
                  },
                  trys: [],
                  ops: [],
                };
              return (
                (r = { next: s(0), throw: s(1), return: s(2) }),
                "function" == typeof Symbol &&
                (r[Symbol.iterator] = function () {
                  return this;
                }),
                r
              );
              function s(s) {
                return function (c) {
                  return (function (s) {
                    if (n)
                      throw new TypeError("Generator is already executing.");
                    for (; r && ((r = 0), s[0] && (a = 0)), a;)
                      try {
                        if (
                          ((n = 1),
                            o &&
                            (i =
                              2 & s[0]
                                ? o.return
                                : s[0]
                                  ? o.throw || ((i = o.return) && i.call(o), 0)
                                  : o.next) &&
                            !(i = i.call(o, s[1])).done)
                        )
                          return i;
                        switch (
                        ((o = 0), i && (s = [2 & s[0], i.value]), s[0])
                        ) {
                          case 0:
                          case 1:
                            i = s;
                            break;
                          case 4:
                            return a.label++, { value: s[1], done: !1 };
                          case 5:
                            a.label++, (o = s[1]), (s = [0]);
                            continue;
                          case 7:
                            (s = a.ops.pop()), a.trys.pop();
                            continue;
                          default:
                            if (
                              !((i = a.trys),
                                (i = i.length > 0 && i[i.length - 1]) ||
                                (6 !== s[0] && 2 !== s[0]))
                            ) {
                              a = 0;
                              continue;
                            }
                            if (
                              3 === s[0] &&
                              (!i || (s[1] > i[0] && s[1] < i[3]))
                            ) {
                              a.label = s[1];
                              break;
                            }
                            if (6 === s[0] && a.label < i[1]) {
                              (a.label = i[1]), (i = s);
                              break;
                            }
                            if (i && a.label < i[2]) {
                              (a.label = i[2]), a.ops.push(s);
                              break;
                            }
                            i[2] && a.ops.pop(), a.trys.pop();
                            continue;
                        }
                        s = e.call(t, a);
                      } catch (t) {
                        (s = [6, t]), (o = 0);
                      } finally {
                        n = i = 0;
                      }
                    if (5 & s[0]) throw s[1];
                    return { value: s[0] ? s[1] : void 0, done: !0 };
                  })([s, c]);
                };
              }
            };
        Object.defineProperty(e, "__esModule", { value: !0 });
        var s = n(5249),
          c = n(8251),
          u = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              if (!0 === n.alreadyInitialized) return n;
              (n.video = n.container.querySelector("video")),
                (n.playButton = n.container.querySelector(
                  ".m-video__play-button"
                )),
                (n.pauseButton = n.container.querySelector(
                  ".m-video__pause-button"
                ));
              var o = n.container.querySelector(".a-timeline");
              o &&
                (o.component
                  ? (n.timeline = o.component)
                  : (n.timeline = new c.default(o))),
                (n.volumeHighButton = n.container.querySelector(
                  ".m-video__volume-high-button"
                )),
                (n.volumeDisabledButton = n.container.querySelector(
                  ".m-video__volume-disabled-button"
                )),
                (n.volumeSlider = n.container.querySelector(
                  ".m-video__volume-slider input"
                )),
                (n.transcriptButton = n.container.querySelector(
                  ".m-video__transcript-button"
                )),
                (n.volumeControllersButton = n.container.querySelector(
                  ".m-video__volume-controllers"
                )),
                (n.fullScreenButton = n.container.querySelector(
                  ".m-video__fullscreen-button"
                )),
                (n.showSubtitlesButton = n.container.querySelector(
                  ".m-video__subtitles-button"
                )),
                (n.hideSubtitlesButton = n.container.querySelector(
                  ".m-video__subtitles-off-button"
                )),
                (n.settingsControllersButton = n.container.querySelector(
                  ".m-video__settings-controllers-button"
                )),
                (n.settingsFlyout = n.container.querySelector(
                  ".m-video__settings-flyout"
                )),
                (n.downloadLinks = n.container.querySelectorAll(
                  ".m-video__download-link"
                )),
                (n.downloadOptionsContainer = n.container.querySelector(
                  ".m-video__download-options"
                )),
                (n.downloadGoBackButton = n.container.querySelector(
                  ".m-video__download-go-back-button"
                )),
                (n.downloadButton = n.container.querySelector(
                  ".m-video__download-button"
                )),
                (n.playbackRateButton = n.container.querySelector(
                  ".m-video__playback-rate-button"
                )),
                (n.playbackRateOptionsContainer = n.container.querySelector(
                  ".m-video__playback-rate-options"
                )),
                (n.playbackRateGoBackButton = n.container.querySelector(
                  ".m-video__playback-rate-go-back-button"
                )),
                (n.playbackRateButtons = n.container.querySelectorAll(
                  ".m-video__playback-rate-option"
                )),
                (n.pictureInPictureButton = n.container.querySelector(
                  ".m-video__picture-in-picture-button"
                )),
                n.video.addEventListener(
                  "loadedmetadata",
                  n.handleVideoMetadata.bind(n)
                );
              var i = n.video.getAttribute("data-sources");
              if ("" !== i) {
                var r = JSON.parse(i);
                if (!(r instanceof Array))
                  throw Error(
                    'No Array of video sources: The video sources should be provided as an Array of sources with type in the data-sources attribute of the video element, e.g. [{"src":"[url].mp4","type":"mp4"}].'
                  );
                r.forEach(function (t) {
                  var e = t.src,
                    o = t.type;
                  if (void 0 === e || void 0 === o)
                    throw Error(
                      'Wrong format of video source: The video source should be provided as an Object with type and src, e.g. {"src":"[url].mp4","type":"mp4"}.'
                    );
                  var i = document.createElement("source");
                  i.setAttribute("key", e),
                    i.setAttribute("src", e),
                    i.setAttribute("type", "video/".concat(o)),
                    n.video.appendChild(i);
                });
              }
              return (
                n.video.addEventListener(
                  "timeupdate",
                  n.handleTimeUpdate.bind(n)
                ),
                n.playButton.addEventListener("click", function () {
                  return n.toggleVideoPlaybackAndFocus(!0);
                }),
                n.pauseButton.addEventListener("click", function () {
                  return n.toggleVideoPlaybackAndFocus(!1);
                }),
                n.timeline.addEventListener(
                  "onRangeChange",
                  n.handleTimelineRangeInput.bind(n)
                ),
                n.timeline.addEventListener(
                  "onMouseup",
                  n.handleTimelineRangeMouseUp.bind(n)
                ),
                n.timeline.addEventListener(
                  "onFocus",
                  n.hideVolumeSlider.bind(n)
                ),
                n.timeline.addEventListener(
                  "onKeyup",
                  n.handleTimelineRangeKeyUp.bind(n)
                ),
                n.transcriptButton.addEventListener(
                  "focus",
                  n.hideVolumeSlider.bind(n)
                ),
                n.volumeHighButton.addEventListener(
                  "click",
                  n.handleVolumeHigh.bind(n)
                ),
                n.volumeHighButton.addEventListener(
                  "focus",
                  n.showVolumeSlider.bind(n)
                ),
                n.volumeDisabledButton.addEventListener(
                  "focus",
                  n.showVolumeSlider.bind(n)
                ),
                n.volumeDisabledButton.addEventListener(
                  "click",
                  n.handleVolumeDisabled.bind(n)
                ),
                n.volumeControllersButton.addEventListener(
                  "mouseover",
                  n.handleVolumeOver.bind(n)
                ),
                n.volumeControllersButton.addEventListener(
                  "mouseout",
                  n.handleVolumeOut.bind(n)
                ),
                n.volumeSlider.addEventListener(
                  "input",
                  n.handleVolumeSlider.bind(n)
                ),
                n.volumeSlider.addEventListener(
                  "keydown",
                  n.handleVolumeSliderKeyDown.bind(n)
                ),
                n.fullScreenButton &&
                (n.fullScreenButton.addEventListener(
                  "click",
                  n.handleFullScreenButtonClick.bind(n)
                ),
                  n.fullScreenButton.addEventListener(
                    "focus",
                    n.handleFullScreenButtonFocus.bind(n)
                  )),
                n.showSubtitlesButton &&
                (n.showSubtitlesButton.addEventListener("click", function () {
                  return n.toggleSubtitles(!0);
                }),
                  n.showSubtitlesButton.addEventListener(
                    "focus",
                    n.handleSubtitlesFocus.bind(n)
                  )),
                n.hideSubtitlesButton &&
                (n.hideSubtitlesButton.addEventListener("click", function () {
                  return n.toggleSubtitles(!1);
                }),
                  n.hideSubtitlesButton.addEventListener(
                    "focus",
                    n.handleSubtitlesFocus.bind(n)
                  )),
                n.settingsFlyout &&
                n.settingsFlyout.addEventListener("keydown", function (t) {
                  n.keepFocusLastElement(t, n.settingsFlyout);
                }),
                n.settingsControllersButton &&
                (n.downloadButton &&
                  n.downloadButton.addEventListener("click", function (t) {
                    return n.handleButtonClick(
                      t,
                      n.showDownloadOptionsContainer()
                    );
                  }),
                  n.settingsControllersButton.addEventListener(
                    "click",
                    n.toggleSettingsFlyout.bind(n)
                  ),
                  n.settingsControllersButton.addEventListener(
                    "focus",
                    n.hideVolumeSlider.bind(n)
                  )),
                n.downloadOptionsContainer &&
                n.downloadOptionsContainer.addEventListener(
                  "keydown",
                  function (t) {
                    n.keepFocusInContainer(t, n.downloadOptionsContainer);
                  }
                ),
                n.downloadGoBackButton &&
                n.downloadGoBackButton.addEventListener(
                  "click",
                  n.handleGoBackButtonClick.bind(n)
                ),
                n.playbackRateButton &&
                n.playbackRateButton.addEventListener("click", function (t) {
                  return n.handleButtonClick(
                    t,
                    n.showPlaybackRateOptionsContainer.bind(n)
                  );
                }),
                n.playbackRateGoBackButton &&
                n.playbackRateGoBackButton.addEventListener(
                  "click",
                  n.handleGoBackButtonClick.bind(n)
                ),
                n.playbackRateButtons.forEach(function (t) {
                  n.handlePlaybackRateOptionClick(t);
                }),
                n.playbackRateOptionsContainer &&
                n.playbackRateOptionsContainer.addEventListener(
                  "keydown",
                  function (t) {
                    n.keepFocusInContainer(t, n.playbackRateOptionsContainer);
                  }
                ),
                n.pictureInPictureButton &&
                n.pictureInPictureButton.addEventListener(
                  "click",
                  n.handlePictureInPictureButtonClick.bind(n)
                ),
                n.container.addEventListener(
                  "click",
                  n.handleDocumentClick.bind(n)
                ),
                n.container.addEventListener(
                  "fullscreenchange",
                  n.handleDocumentFullScreenChange.bind(n)
                ),
                (n.isVideoPlaying = !1),
                (n.isVolumeHovering = !1),
                (n.video.volume = 0.5),
                (n.volumeSlider.valueAsNumber = 50),
                (n.activePlaybackRate = 1),
                n
              );
            }
            return (
              i(e, t),
              (e.prototype.formatTime = function (t) {
                var e = Math.floor(t / 60),
                  n = Math.floor(t % 60);
                return ""
                  .concat(e.toString().padStart(2, "0"), ":")
                  .concat(n.toString().padStart(2, "0"));
              }),
              (e.prototype.handleTimeUpdate = function () {
                this.timeline.setCurrent(this.video.currentTime);
              }),
              (e.prototype.handleVideoMetadata = function () {
                this.timeline.setDuration(this.video.duration);
              }),
              (e.prototype.toggleVideoPlaybackAndFocus = function (t) {
                (this.isVideoPlaying = t),
                  t
                    ? (this.video.play(),
                      this.playButton.classList.remove("-show"),
                      this.pauseButton.classList.add("-show"),
                      this.pauseButton.focus(),
                      this.playButton.setAttribute("aria-hidden", "false"),
                      this.pauseButton.setAttribute("aria-hidden", "true"),
                      this.timeline.setPlayingState(!0))
                    : (this.video.pause(),
                      this.pauseButton.classList.remove("-show"),
                      this.playButton.classList.add("-show"),
                      this.playButton.focus(),
                      this.playButton.setAttribute("aria-hidden", "true"),
                      this.pauseButton.setAttribute("aria-hidden", "false"),
                      this.timeline.setPlayingState(!1)),
                  this.timeline.setCurrent(this.video.currentTime);
              }),
              (e.prototype.updateVolumeSlider = function (t, e) {
                var n = t;
                (n.value = e.toString()),
                  n.setAttribute("value", n.value),
                  n.setAttribute("aria-valuenow", n.value),
                  n.style.setProperty("--slider-percentage", "".concat(e));
              }),
              (e.prototype.handleTimelineRangeInput = function (t) {
                this.video.pause(), (this.video.currentTime = t);
              }),
              (e.prototype.handleTimelineRangeMouseUp = function () {
                this.isVideoPlaying && this.video.play();
              }),
              (e.prototype.handleVolumeHigh = function () {
                (this.video.muted = !0),
                  this.volumeHighButton.classList.remove("-show"),
                  this.volumeDisabledButton.classList.add("-show"),
                  this.volumeDisabledButton.focus(),
                  this.volumeHighButton.setAttribute("aria-hidden", "false"),
                  this.volumeDisabledButton.setAttribute("aria-hidden", "true");
              }),
              (e.prototype.handleVolumeDisabled = function () {
                (this.video.muted = !1),
                  this.volumeDisabledButton.classList.remove("-show"),
                  this.volumeHighButton.classList.add("-show"),
                  this.volumeHighButton.focus(),
                  this.volumeDisabledButton.setAttribute(
                    "aria-hidden",
                    "false"
                  ),
                  this.volumeHighButton.setAttribute("aria-hidden", "true");
              }),
              (e.prototype.handleVolumeOver = function () {
                (this.isVolumeHovering = !0),
                  this.settingsFlyout && this.hideSettingsFlyout(),
                  this.playbackRateOptionsContainer &&
                  this.hidePlaybackRateOptionsContainer(),
                  this.showVolumeSlider();
              }),
              (e.prototype.handleVolumeOut = function () {
                var t = this;
                (this.isVolumeHovering = !1),
                  setTimeout(function () {
                    t.isVolumeHovering || t.hideVolumeSlider();
                  }, 100);
              }),
              (e.prototype.handleVolumeSlider = function () {
                var t = this.volumeSlider.valueAsNumber / 100;
                (this.video.volume = t),
                  0 === t
                    ? this.handleVolumeHigh()
                    : this.handleVolumeDisabled();
                var e = Math.floor(parseFloat(this.volumeSlider.value));
                this.updateVolumeSlider(this.volumeSlider, e);
              }),
              (e.prototype.handleVolumeSliderKeyDown = function (t) {
                if ("ArrowLeft" === t.key) {
                  t.preventDefault();
                  var e = parseFloat(this.volumeSlider.value),
                    n = Math.max(e - 1, parseFloat(this.volumeSlider.min));
                  (this.volumeSlider.valueAsNumber = n),
                    this.handleVolumeSlider(),
                    this.volumeSlider.focus();
                } else if ("ArrowRight" === t.key) {
                  t.preventDefault();
                  (e = parseFloat(this.volumeSlider.value)),
                    (n = Math.min(e + 1, parseFloat(this.volumeSlider.max)));
                  (this.volumeSlider.value = n.toString()),
                    this.handleVolumeSlider(),
                    this.volumeSlider.focus();
                }
              }),
              (e.prototype.handleFullScreenButtonClick = function () {
                this.video.requestFullscreen();
              }),
              (e.prototype.handleFullScreenButtonFocus = function () {
                this.hideVolumeSlider(), this.hideSettingsFlyout();
              }),
              (e.prototype.handleDocumentFullScreenChange = function () {
                !document.fullscreenElement &&
                  this.fullScreenButton &&
                  this.fullScreenButton.focus();
              }),
              (e.prototype.handleButtonClick = function (t, e) {
                t.stopPropagation(), e && e(), this.hideSettingsFlyout();
              }),
              (e.prototype.handlePlaybackRateOptionClick = function (t) {
                var e = this;
                t.addEventListener("click", function (n) {
                  n.stopPropagation();
                  var o = parseFloat(t.getAttribute("data-rate"));
                  if (o !== e.activePlaybackRate) {
                    var i = document.querySelector(
                      '[data-rate="'.concat(e.activePlaybackRate, '"]')
                    );
                    if (i) {
                      var r = i.querySelector(
                        ".m-video__playback-rate-checkmark"
                      );
                      r && r.classList.remove("active-rate");
                    }
                    e.activePlaybackRate = o;
                    var a = t.querySelector(
                      ".m-video__playback-rate-checkmark"
                    );
                    a && a.classList.add("active-rate"),
                      (e.video.playbackRate = o),
                      e.hideSettingsFlyout(),
                      e.hidePlaybackRateOptionsContainer(),
                      e.settingsControllersButton.focus();
                  }
                });
              }),
              (e.prototype.handleDocumentClick = function (t) {
                var e = t.target;
                (this.settingsControllersButton &&
                  this.settingsControllersButton.contains(e)) ||
                  (this.settingsFlyout && this.settingsFlyout.contains(e)) ||
                  (this.playbackRateOptionsContainer &&
                    this.playbackRateOptionsContainer.contains(e)) ||
                  (this.settingsFlyout && this.hideSettingsFlyout(),
                    this.playbackRateOptionsContainer &&
                    this.hidePlaybackRateOptionsContainer());
              }),
              (e.prototype.showVolumeSlider = function () {
                this.settingsFlyout && this.hideSettingsFlyout(),
                  this.volumeSlider.parentElement.classList.add("-show");
              }),
              (e.prototype.hideVolumeSlider = function () {
                this.volumeSlider.parentElement.classList.remove("-show");
              }),
              (e.prototype.handleTimelineRangeKeyUp = function (t) {
                ("ArrowRight" !== t.key && "ArrowLeft" !== t.key) ||
                  this.handleTimelineRangeMouseUp();
              }),
              (e.prototype.handleSubtitlesFocus = function () {
                this.hideSettingsFlyout();
              }),
              (e.prototype.toggleSubtitles = function (t) {
                var e = !t;
                this.showSubtitlesButton.classList.toggle("-show", e),
                  this.hideSubtitlesButton.classList.toggle("-show", t),
                  this.showSubtitlesButton.setAttribute(
                    "aria-hidden",
                    t.toString()
                  ),
                  this.hideSubtitlesButton.setAttribute(
                    "aria-hidden",
                    e.toString()
                  ),
                  t
                    ? this.hideSubtitlesButton.focus()
                    : this.showSubtitlesButton.focus();
                var n = this.video.textTracks;
                n && n.length > 0 && (n[0].mode = t ? "showing" : "hidden");
              }),
              (e.prototype.toggleSettingsFlyout = function () {
                this.settingsFlyout.classList.contains("-show")
                  ? this.hideSettingsFlyout()
                  : this.showSettingsFlyout();
              }),
              (e.prototype.showSettingsFlyout = function () {
                this.settingsFlyout.classList.add("-show"),
                  this.hideVolumeSlider();
              }),
              (e.prototype.hideSettingsFlyout = function () {
                this.settingsFlyout.classList.remove("-show");
              }),
              (e.prototype.showPlaybackRateOptionsContainer = function () {
                this.playbackRateOptionsContainer.classList.add("-show"),
                  this.playbackRateGoBackButton.focus();
              }),
              (e.prototype.hidePlaybackRateOptionsContainer = function () {
                this.playbackRateOptionsContainer.classList.remove("-show");
              }),
              (e.prototype.showDownloadOptionsContainer = function () {
                this.downloadOptionsContainer.classList.add("-show"),
                  this.downloadGoBackButton.focus();
              }),
              (e.prototype.hideDownloadOptionsContainer = function () {
                this.downloadOptionsContainer.classList.remove("-show"),
                  this.showSettingsFlyout();
              }),
              (e.prototype.keepFocusLastElement = function (t, e) {
                var n = Array.from(e.querySelectorAll("button, a"));
                if ("Tab" === t.key) {
                  var o = n[n.length - 1];
                  t.shiftKey ||
                    document.activeElement !== o ||
                    (t.preventDefault(), e.focus());
                }
              }),
              (e.prototype.keepFocusInContainer = function (t, e) {
                var n = Array.from(e.querySelectorAll("button, a"));
                if ("Tab" === t.key) {
                  var o = n[0],
                    i = n[n.length - 1];
                  t.shiftKey
                    ? document.activeElement === o &&
                    (t.preventDefault(), o.focus())
                    : document.activeElement === i &&
                    (t.preventDefault(), i.focus());
                }
              }),
              (e.prototype.handleGoBackButtonClick = function (t) {
                t.stopPropagation(),
                  this.playbackRateOptionsContainer &&
                  this.hidePlaybackRateOptionsContainer(),
                  this.downloadOptionsContainer &&
                  this.hideDownloadOptionsContainer(),
                  this.showSettingsFlyout(),
                  this.settingsFlyout.querySelector("button").focus();
              }),
              (e.prototype.handlePictureInPictureButtonClick = function () {
                return r(this, void 0, Promise, function () {
                  return a(this, function (t) {
                    return (
                      document.pictureInPictureElement
                        ? document.exitPictureInPicture()
                        : document.pictureInPictureEnabled &&
                        this.video.requestPictureInPicture(),
                      this.hideSettingsFlyout(),
                      this.settingsControllersButton.focus(),
                      [2]
                    );
                  });
                });
              }),
              e
            );
          })(s.default);
        e.default = u;
      },
      6951: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = n(5249),
          a = n(4123),
          s = n(8336),
          c = n(2063),
          u = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              if (!0 === n.alreadyInitialized) return n;
              (n.escapeKeyHelper = new a.default(
                n.close.bind(n),
                n.isOpen.bind(n)
              )),
                (n.contextMenuTriggerOpen = e.querySelector(
                  '.o-context-menu__trigger[data-frok-action="open"]'
                )),
                (n.contextMenuTriggerClose = e.querySelector(
                  '.o-context-menu__trigger[data-frok-action="close"]'
                )),
                (n.popoverElement = e.querySelector(".m-popover")),
                (n.popover = new c.default(n.popoverElement));
              var o = e.querySelector(".m-menu-group");
              return (
                o && (n.menuGroup = new s.default(o)),
                (n.contextMenuTriggerOpen || n.contextMenuTriggerClose) &&
                (n.contextMenuTriggerOpen.addEventListener(
                  "click",
                  function () {
                    n.open();
                  }
                ),
                  n.contextMenuTriggerClose.addEventListener(
                    "click",
                    function () {
                      n.close();
                    }
                  )),
                document.addEventListener("click", function (t) {
                  t.composedPath().includes(n.container) ||
                    (n.menuGroup.closeGroups(),
                      n.menuGroup.closeFlyouts(),
                      n.close());
                }),
                n
              );
            }
            return (
              i(e, t),
              (e.prototype.open = function () {
                this.container.classList.add("-open"),
                  this.popover.attach(
                    this.contextMenuTriggerClose,
                    this.container
                  ),
                  this.popover.show(),
                  this.escapeKeyHelper.enable(),
                  this.menuGroup.focusFirstMenuItem();
              }),
              (e.prototype.close = function () {
                this.container.classList.remove("-open"),
                  this.popover.hide(),
                  this.menuGroup.closeGroups(),
                  this.menuGroup.closeFlyouts(),
                  this.escapeKeyHelper.disable(),
                  this.contextMenuTriggerClose === document.activeElement &&
                  this.contextMenuTriggerOpen.focus();
              }),
              (e.prototype.setPosition = function (t) {
                this.popover.setPosition(t);
              }),
              (e.prototype.isOpen = function () {
                return this.container.classList.contains("-open");
              }),
              e
            );
          })(r.default);
        e.default = u;
      },
      8982: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = n(5249),
          a = n(4123),
          s = n(7045),
          c = function (t) {
            return Array.from(t.children).find(function (t) {
              return t.classList.contains("o-header__navigation-sub-level");
            });
          },
          u = function (t) {
            return Array.from(t.children).find(function (t) {
              return t.classList.contains("o-header__navigation-trigger");
            });
          },
          l = function (t, e) {
            Array.from(t.children)
              .map(function (t) {
                return Array.from(t.children);
              })
              .reduce(function (t, e) {
                return t.concat(e);
              })
              .filter(function (t) {
                return t.classList.contains("o-header__navigation-trigger");
              })
              .forEach(function (t) {
                ("button" === t.tagName.toLowerCase()
                  ? t
                  : t.children.item(0)
                ).setAttribute("tabindex", e.toString(10));
              });
          },
          d = function (t) {
            var e = c(t);
            e &&
              (t.classList.remove("-open"),
                u(t).setAttribute("aria-expanded", "false"),
                e.setAttribute("aria-hidden", "true"),
                l(e, -1));
          },
          p = function (t, e, n, o) {
            t.element.setAttribute("aria-hidden", o ? "false" : "true"),
              o ? t.enableListeners() : t.disableListeners(),
              Array.from(t.element.children[0].children)
                .filter(function (t) {
                  return (
                    "button" === t.tagName.toLowerCase() ||
                    "input" === t.tagName.toLowerCase()
                  );
                })
                .forEach(function (t) {
                  return t.setAttribute("tabindex", o ? "0" : "-1");
                }),
              e.setAttribute("aria-expanded", o ? "true" : "false"),
              e.setAttribute("tabindex", o ? "-1" : "0"),
              n.setAttribute("tabindex", o ? "0" : "-1");
          },
          h = function (t, e, n) {
            return p(t, e, n, !1);
          },
          f = function (t) {
            t.forEach(d);
          },
          y = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              (n.menuTrigger = e.querySelector(".o-header__menu-trigger")),
                (n.searchTrigger = e.querySelector(".o-header__search-open")),
                (n.searchCloseTrigger = e.querySelector(
                  ".o-header__search .m-search-form .a-search-input__icon-close"
                ));
              var o = e.querySelector(".o-header__search .m-search-form");
              return (
                (n.searchForm = o
                  ? new s.default(o, n.isSearchOpen.bind(n))
                  : null),
                (n.pageMarginContainer = e.querySelector(".e-container")),
                (n.navigationTriggers = Array.from(
                  e.querySelectorAll("button.o-header__navigation-trigger")
                )),
                (n.navigationCloseTriggers = Array.from(
                  e.querySelectorAll(
                    "button.o-header__navigation-close-trigger"
                  )
                )),
                (n.firstLevelNavigationEntries = Array.from(
                  e.querySelectorAll(".o-header__navigation-first-level-item")
                )),
                (n.secondLevelNavigationEntries = Array.from(
                  e.querySelectorAll(
                    ".o-header__navigation-first-level-item > ul > .o-header__navigation-sub-level-item"
                  )
                )),
                n.menuTrigger.addEventListener("click", function () {
                  n.closeMenu(),
                    n.isMenuOpen() && n.escapeKeyHelperMenu.enable();
                }),
                n.searchTrigger &&
                n.searchTrigger.addEventListener("click", function () {
                  var t, o, i;
                  n.escapeKeyHelperMenu.disable(),
                    e.classList.add("-search-open"),
                    e.classList.remove("-menu-open"),
                    n.adjustSearchFieldWidth(),
                    (t = n.searchForm),
                    (o = n.searchTrigger),
                    (i = n.searchCloseTrigger),
                    p(t, o, i, !0),
                    n.searchForm.searchInput.focusInput();
                }),
                n.searchCloseTrigger &&
                n.searchCloseTrigger.addEventListener(
                  "click",
                  n.closeSearch.bind(n)
                ),
                n.searchForm &&
                n.searchTrigger &&
                n.searchCloseTrigger &&
                h(n.searchForm, n.searchTrigger, n.searchCloseTrigger),
                n.searchForm &&
                (window.addEventListener("resize", function () {
                  return n.adjustSearchFieldWidth();
                }),
                  n.searchForm.searchInput.setAlwaysShowCloseButton(!0)),
                n.navigationTriggers.forEach(function (t) {
                  var o = (function (t) {
                    return t.parentElement;
                  })(t),
                    i = t.parentElement.classList.contains(
                      "o-header__navigation-first-level-item"
                    );
                  t.addEventListener("click", function () {
                    var t, r;
                    o
                      .querySelector(".o-header__navigation-close-trigger")
                      .setAttribute("tabindex", "0"),
                      (o.parentElement.scrollTop = 0),
                      f(n.secondLevelNavigationEntries),
                      i
                        ? (f(n.firstLevelNavigationEntries),
                          e.classList.add("-second-level-open"),
                          e.classList.remove("-third-level-open"))
                        : (e.classList.remove("-second-level-open"),
                          e.classList.add("-third-level-open")),
                      (r = c((t = o))) &&
                      (t.classList.add("-open"),
                        u(t).setAttribute("aria-expanded", "true"),
                        c(t).setAttribute("aria-hidden", "false"),
                        l(r, 0));
                  });
                }),
                n.navigationCloseTriggers.forEach(function (t) {
                  t.setAttribute("tabindex", "-1");
                  var n = t.parentElement.parentElement,
                    o = n.classList.contains(
                      "o-header__navigation-first-level-item"
                    );
                  t.addEventListener("click", function () {
                    t.setAttribute("tabindex", "-1"),
                      e.classList.remove("-third-level-open"),
                      o
                        ? e.classList.remove("-second-level-open")
                        : e.classList.add("-second-level-open"),
                      d(n);
                  });
                }),
                (n.closeMenu = n.closeMenu.bind(n)),
                (n.isMenuOpen = n.isMenuOpen.bind(n)),
                (n.closeSearch = n.closeSearch.bind(n)),
                (n.isSearchOpen = n.isSearchOpen.bind(n)),
                (n.escapeKeyHelperMenu = new a.default(
                  n.closeMenu,
                  n.isMenuOpen
                )),
                n.searchForm && n.initSearchForm(),
                n
              );
            }
            return (
              i(e, t),
              (e.prototype.adjustSearchFieldWidth = function () {
                if (this.container.classList.contains("-search-open")) {
                  var t = this.menuTrigger.offsetWidth,
                    e = this.pageMarginContainer.offsetWidth;
                  this.searchForm.element.style.width = "calc(".concat(
                    e - t,
                    "px + 1rem)"
                  );
                } else this.searchForm.element.style.width = "0px";
              }),
              (e.prototype.closeMenu = function () {
                this.container.classList.toggle("-menu-open"),
                  f(this.firstLevelNavigationEntries),
                  f(this.secondLevelNavigationEntries),
                  this.container.classList.remove("-second-level-open"),
                  this.container.classList.remove("-third-level-open"),
                  this.searchForm &&
                  this.searchTrigger &&
                  this.searchCloseTrigger &&
                  (this.container.classList.remove("-search-open"),
                    h(
                      this.searchForm,
                      this.searchTrigger,
                      this.searchCloseTrigger
                    )),
                  this.menuTrigger.focus();
              }),
              (e.prototype.isMenuOpen = function () {
                return this.container.classList.contains("-menu-open");
              }),
              (e.prototype.isSearchOpen = function () {
                return this.container.classList.contains("-search-open");
              }),
              (e.prototype.closeSearch = function () {
                this.adjustSearchFieldWidth(),
                  this.container.classList.remove("-search-open"),
                  this.container.classList.remove("-show-suggestions"),
                  this.searchForm &&
                  this.searchTrigger &&
                  this.searchCloseTrigger &&
                  h(
                    this.searchForm,
                    this.searchTrigger,
                    this.searchCloseTrigger
                  ),
                  this.searchTrigger.focus();
              }),
              (e.prototype.initSearchForm = function () {
                var t = this;
                this.searchForm.addEventListener(
                  s.EVENT_SEARCH_CLEAR,
                  function () {
                    t.searchForm.enableListeners();
                  }
                ),
                  this.searchForm.addEventListener(
                    s.EVENT_SEARCH_CLOSE,
                    function () {
                      t.closeSearch();
                    }
                  );
              }),
              (e.events = ["searchClear", "searchClose"]),
              e
            );
          })(r.default);
        e.default = y;
      },
      7695: function (t, e, n) {
        var o,
          i =
            (this && this.__extends) ||
            ((o = function (t, e) {
              return (o =
                Object.setPrototypeOf ||
                ({ __proto__: [] } instanceof Array &&
                  function (t, e) {
                    t.__proto__ = e;
                  }) ||
                function (t, e) {
                  for (var n in e)
                    Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                })(t, e);
            }),
              function (t, e) {
                if ("function" != typeof e && null !== e)
                  throw new TypeError(
                    "Class extends value " +
                    String(e) +
                    " is not a constructor or null"
                  );
                function n() {
                  this.constructor = t;
                }
                o(t, e),
                  (t.prototype =
                    null === e
                      ? Object.create(e)
                      : ((n.prototype = e.prototype), new n()));
              });
        Object.defineProperty(e, "__esModule", { value: !0 });
        var r = n(5249),
          a = n(4222),
          s = n(9065),
          c = n(6536),
          u = n(6951),
          l = "250ms margin-left cubic-bezier(0.38, 0.04, 0.35, 0.96)",
          d = (function (t) {
            function e(e) {
              var n = t.call(this, e) || this;
              return (
                (n.sideNavigationElement =
                  document.querySelector(".m-side-navigation")),
                (n.contextMenuElement = e.querySelector(".o-context-menu")),
                n.contextMenuElement &&
                (n.contextMenuElement.component
                  ? (n.contextMenu = n.contextMenuElement.component)
                  : (n.contextMenu = new u.default(n.contextMenuElement))),
                (n.burger = e.querySelector(
                  ".o-minimal-header__burger button"
                )),
                (n.content = document.querySelector(".e-container")),
                (n.openMenuDesktop = n.sideNavigationElement.querySelector(
                  ".m-side-navigation__header__trigger.-open"
                )),
                (n.closeMenuDesktop = n.sideNavigationElement.querySelector(
                  ".m-side-navigation__header__trigger.-close"
                )),
                (n.menuItemsDesktop = Array.from(
                  e.querySelectorAll(
                    ".m-side-navigation__menuItems > .a-menu-item"
                  )
                )),
                n.sideNavigationElement.component
                  ? ((n.sideNavigation = n.sideNavigationElement.component),
                    n.sideNavigation.setExternalTrigger(n.burger))
                  : (n.sideNavigation = new s.default(
                    n.sideNavigationElement,
                    n.burger
                  )),
                n.burger.addEventListener("click", function () {
                  n.sideNavigation.show();
                }),
                n.adjustPopoverArrowPosition(),
                n.pushContent(),
                window.addEventListener("resize", function () {
                  n.adjustPopoverArrowPosition(), n.pushContent();
                }),
                n
              );
            }
            return (
              i(e, t),
              (e.prototype.adjustPopoverArrowPosition = function () {
                window.matchMedia(c.default.TABLET_AND_UP).matches
                  ? this.contextMenu.setPosition(a.ArrowPosition.TOP_CENTER)
                  : this.contextMenu.setPosition(a.ArrowPosition.TOP_RIGHT);
              }),
              (e.prototype.pushContent = function () {
                var t = this;
                this.content &&
                  (this.openMenuDesktop.addEventListener("click", function () {
                    t.content.classList.add("-open");
                    var e = t.calculateMarginLeft();
                    (t.content.style.marginLeft = "".concat(e, "px")),
                      (t.content.style.transition = l);
                  }),
                    this.menuItemsDesktop.forEach(function (e) {
                      e.addEventListener("click", function () {
                        t.content.classList.add("-open");
                        var e = t.calculateMarginLeft();
                        (t.content.style.marginLeft = "".concat(e, "px")),
                          (t.content.style.transition = l);
                      });
                    }),
                    this.closeMenuDesktop.addEventListener("click", function () {
                      t.content.classList.remove("-open"),
                        (t.content.style.marginLeft = "unset"),
                        (t.content.style.margin = "0 auto");
                    }));
              }),
              (e.prototype.calculateMarginLeft = function () {
                return (
                  304 +
                  (window.innerWidth -
                    304 -
                    (this.content.getBoundingClientRect().right -
                      this.content.getBoundingClientRect().left)) /
                  2
                );
              }),
              e
            );
          })(r.default);
        e.default = d;
      },
      6536: (t, e) => {
        var n;
        Object.defineProperty(e, "__esModule", { value: !0 }),
          (function (t) {
            (t.TABLET_AND_UP = "(min-width: 768px)"),
              (t.DESKTOP_AND_UP = "(min-width: 1194px)");
          })(n || (n = {})),
          (e.default = n);
      },
    },
      e = {};
    function n(o) {
      var i = e[o];
      if (void 0 !== i) return i.exports;
      var r = (e[o] = { exports: {} });
      return t[o].call(r.exports, r, r.exports, n), r.exports;
    }
    (() => {
      var t = n(4135),
        e = n(6359),
        o = n(3665),
        i = n(5508),
        r = n(7420),
        a = n(790),
        s = n(798),
        c = n(7780),
        u = n(5038),
        l = n(4797),
        d = n(1762),
        p = n(5158),
        h = n(8251),
        f = n(4688),
        y = n(8740),
        v = n(4028),
        m = n(4194),
        g = n(7160),
        b = n(3031),
        _ = n(3050),
        w = n(349),
        L = n(2063),
        E = n(3698),
        O = n(8336),
        T = n(1319),
        S = n(7779),
        C = n(2594),
        A = n(9065),
        k = n(1270),
        P = n(7045),
        B = n(9023),
        x = n(6951),
        I = n(8982),
        M = n(7695),
        R = [
          { Component: t.default, selector: ".a-accordion" },
          { Component: r.default, selector: ".a-checkbox" },
          { Component: c.default, selector: ".a-details" },
          { Component: m.default, selector: ".a-search-input" },
          { Component: a.default, selector: ".a-color-input" },
          { Component: s.default, selector: ".a-animated-icon" },
          { Component: E.default, selector: ".m-lightbox" },
          { Component: w.default, selector: ".m-dialog" },
          { Component: u.default, selector: ".a-box--modal" },
          { Component: d.default, selector: ".a-meter" },
          { Component: l.default, selector: ".a-file-upload-input" },
          { Component: _.default, selector: ".m-audio" },
          { Component: L.default, selector: ".m-popover:not(.-detached)" },
          { Component: S.default, selector: ".m-upload-area" },
          { Component: T.default, selector: ".m-search-bar" },
          { Component: e.default, selector: ".a-text-field" },
          { Component: o.default, selector: ".a-password-input" },
          { Component: i.default, selector: ".a-text-area" },
          { Component: p.default, selector: ".a-notification--banner" },
          { Component: h.default, selector: ".a-timeline" },
          { Component: f.default, selector: ".a-progress-indicator-container" },
          { Component: k.default, selector: ".m-form-field" },
          {
            Component: A.default,
            selector: ".m-side-navigation:not(.-detached)",
          },
          { Component: g.default, selector: ".a-slider" },
          { Component: B.default, selector: ".a-page-indicator" },
          { Component: y.default, selector: ".a-value-modificator" },
          { Component: b.default, selector: ".a-tab-navigation" },
          { Component: x.default, selector: ".o-context-menu" },
          { Component: I.default, selector: ".o-header" },
          { Component: M.default, selector: ".o-minimal-header:not(.-detached)" },
          { Component: v.default, selector: ".a-rating" },
          { Component: P.default, selector: ".m-search-form" },
          { Component: C.default, selector: ".m-video" },
          { Component: O.default, selector: ".m-menu-group" },
        ],
        F = {
          Box: u.default,
          Dialog: w.default,
          Lightbox: E.default,
          Popover: L.default,
          Notification: p.default,
        };
      Object.freeze(F),
        window.boschFrontendKit ||
        Object.defineProperty(window, "boschFrontendKit", {
          get: function () {
            return F;
          },
        }),
        R.forEach(function (t) {
          Array.from(document.querySelectorAll(t.selector)).forEach(function (e) {
            e.component || new t.Component(e);
          });
        });
      var q = new CustomEvent("bosch.frontend-kit-done");
      document.dispatchEvent(q);
    })();
  })();

});

