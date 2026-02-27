(function () {
  var script = document.currentScript;
  if (!script) {
    var scripts = document.getElementsByTagName("script");
    script = scripts[scripts.length - 1];
  }

  // Support nested folders using a 'data-base-path' attribute
  // e.g., <script src="../assets/js/header.js" data-base-path=".."></script>
  var pathAttr = script.getAttribute("data-base-path");
  var basePath =
    pathAttr && pathAttr !== "." ? pathAttr.replace(/\/$/, "") + "/" : "";

  var headerHTML = `
    <header>

        <!-- header area start -->
        <div id="header-sticky"
            class="tp-header-area tp-header-13-ptb sticky-white-bg tp-header-blur header-transparent">
            <div class="container container-1750">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-5 col-5">
                        <div class="tp-header-logo">
                            <a href="${basePath}index.html"><img style="border-radius: 50px;" data-width="140"
                                    src="${basePath}assets/img/logo/logo.jpeg" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-7 col-7">
                        <div
                            class="tp-header-box d-flex align-items-center justify-content-end justify-content-xl-between">
                            <div
                                class="tp-header-menu tp-header-13-menu tp-header-dropdown dropdown-black-bg d-none d-xl-flex">
                                <nav class="tp-mobile-menu-active">
                                    <ul>

                                        <li>
                                            <a href="${basePath}index.html">Home</a>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0)">About Us</a>
                                        </li>

                                        <li class="has-dropdown">
                                            <a href="javascript:void(0)">Expertise</a>
                                            <ul class="tp-submenu submenu">
                                                <li><a href="${basePath}service.html">Finance Accounts Compliance Outsourcing
                                                        Services</a></li>
                                                <li><a href="javascript:void(0)">Deals, Due Diligence & Transaction
                                                        Advisory Services</a></li>
                                                <li><a href="javascript:void(0)">Risk Advisory & Augmenting Business
                                                        Process Services</a></li>
                                                <li><a href="javascript:void(0)">IPO Advisory Services</a></li>
                                                <li><a href="javascript:void(0)">Virtual CFO Services</a></li>
                                                <li><a href="javascript:void(0)">M &amp; A Advisory Services</a></li>
                                                <li><a href="javascript:void(0)">GCC (Global Capability Centers)</a>
                                                </li>
                                                <li><a href="javascript:void(0)">Business Setup &amp; Startup
                                                        Collaboration Services</a></li>
                                                <li><a href="javascript:void(0)">Corporate Governance Services</a></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0)">Careers</a>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0)">Events</a>
                                        </li>

                                        <li class="has-dropdown">
                                            <a href="javascript:void(0)">Insights</a>
                                            <ul class="tp-submenu submenu">
                                                <li><a href="javascript:void(0)">Newsletters</a></li>
                                                <li><a href="${basePath}blog.html">Blogs</a></li>
                                                <li><a href="javascript:void(0)">Tax Alert</a></li>
                                                <li><a href="javascript:void(0)">Deal Alert</a></li>
                                                <li><a href="javascript:void(0)">Case Study</a></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="${basePath}contact.html">Contact Us</a>
                                        </li>

                                    </ul>
                                </nav>
                            </div>
                            <div class="tp-header-right d-flex align-items-center justify-content-end">
                                <div class="tp-header-btn-box d-none d-md-block ml-15">
                                    <a href="${basePath}contact.html" class="tp-btn-white-border">Free Consultation
                                        <span><svg xmlns="http://www.w3.org/2000/svg" width="15" height="12"
                                                viewBox="0 0 15 12" fill="none">
                                                <path
                                                    d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z"
                                                    fill="currentColor"></path>
                                            </svg></span>
                                    </a>
                                </div>
                                <div class="tp-header-btn-box d-none d-md-block ml-15">
                                    <a href="${basePath}contact.html" class="tp-btn-white-border">Financial Review
                                        <span><svg xmlns="http://www.w3.org/2000/svg" width="15" height="12"
                                                viewBox="0 0 15 12" fill="none">
                                                <path
                                                    d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z"
                                                    fill="currentColor"></path>
                                            </svg></span>
                                    </a>
                                </div>
                                <div class="tp-header-bar ml-20 d-xl-none">
                                    <button class="tp-offcanvas-open-btn">
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header area end -->

    </header>
    `;

  // Write the HTML directly into the document where the script is currently located.
  // This executes synchronously when the script tag is parsed, making it behave identically
  // to placing the HTML tag naturally in the source file, guaranteeing zero layout shift
  // and full immediate availability to downstream scripts.
  document.write(headerHTML);
})();
