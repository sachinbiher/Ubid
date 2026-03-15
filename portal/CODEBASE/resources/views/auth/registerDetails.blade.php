@extends('layouts.auth')

@push('PAGE_ASSETS_CSS')
<link rel="stylesheet" type="text/css" href="app-assets/css/vendorDetail-style.css">
<style>
    html .content {
    padding: 0;
    position: relative;
    transition: all .3s ease;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    min-height: calc(100% - 3.35rem);
    margin-left: 150px;
    }

    [type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled) {
    cursor: default!important;
    }

    .btn:not(:disabled):not(.disabled), .carousel-indicators li, [role=button], [type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled), summary {
        cursor: default!important;
    }
   #loading-bg {
        width: 100%;
        height: 100%;
        background: #fff;
        display: block;
        position: absolute;
        z-index: 99999;
        pointer-events: none;
      }
      .loading-logo {
        position: absolute;
        left: calc(50% - 45px);
        top: 40%;
      }
      .loading {
        position: absolute;
        left: calc(50% - 35px);
        top: 50%;
        width: 55px;
        height: 55px;
        border-radius: 50%;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        border: 3px solid transparent;
      }
      .loading .effect-1,
      .loading .effect-2 {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 3px solid transparent;
        border-left: 3px solid rgb(112 72 45);
        border-radius: 50%;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
      }
      .loading .effect-1 {
        animation: rotate 1s ease infinite;
      }
      .loading .effect-2 {
        animation: rotateOpacity 1s ease infinite 0.1s;
      }
      .loading .effect-3 {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 3px solid transparent;
        border-left: 3px solid rgb(112 72 45);
        -webkit-animation: rotateOpacity 1s ease infinite 0.2s;
        animation: rotateOpacity 1s ease infinite 0.2s;
        border-radius: 50%;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
      }
      .loading .effects {
        transition: all 0.3s ease;
      }
      @keyframes rotate {
        0% {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
        }
        100% {
          -webkit-transform: rotate(1turn);
          transform: rotate(1turn);
        }
      }
      @keyframes rotateOpacity {
        0% {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
          opacity: 0.1;
        }
        100% {
          -webkit-transform: rotate(1turn);
          transform: rotate(1turn);
          opacity: 1;
        }
      }
      @font-face{font-family:'Montserrat';font-style:italic;font-weight:400;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUQjIg1_i6t8kCHKm459WxhzQ.woff) format('woff');}@font-face{font-family:'Montserrat';font-style:italic;font-weight:500;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUPjIg1_i6t8kCHKm459WxZOg3D-A.woff) format('woff');}@font-face{font-family:'Montserrat';font-style:italic;font-weight:600;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUPjIg1_i6t8kCHKm459WxZFgrD-A.woff) format('woff');}@font-face{font-family:'Montserrat';font-style:normal;font-weight:300;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_cJD7g0.woff) format('woff');}@font-face{font-family:'Montserrat';font-style:normal;font-weight:400;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUSjIg1_i6t8kCHKm45xW0.woff) format('woff');}@font-face{font-family:'Montserrat';font-style:normal;font-weight:500;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_ZpC7g0.woff) format('woff');}@font-face{font-family:'Montserrat';font-style:normal;font-weight:600;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_bZF7g0.woff) format('woff');}@font-face{font-family:'Montserrat';font-style:italic;font-weight:400;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUQjIg1_i6t8kCHKm459WxRxC7m0dR9pBOi.woff2) format('woff2');unicode-range:U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;}@font-face{font-family:'Montserrat';font-style:italic;font-weight:400;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUQjIg1_i6t8kCHKm459WxRzS7m0dR9pBOi.woff2) format('woff2');unicode-range:U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;}@font-face{font-family:'Montserrat';font-style:italic;font-weight:400;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUQjIg1_i6t8kCHKm459WxRxi7m0dR9pBOi.woff2) format('woff2');unicode-range:U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;}@font-face{font-family:'Montserrat';font-style:italic;font-weight:400;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUQjIg1_i6t8kCHKm459WxRxy7m0dR9pBOi.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}@font-face{font-family:'Montserrat';font-style:italic;font-weight:400;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUQjIg1_i6t8kCHKm459WxRyS7m0dR9pA.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}@font-face{font-family:'Montserrat';font-style:italic;font-weight:500;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUPjIg1_i6t8kCHKm459WxZOg3z8fZwjimrq1Q_.woff2) format('woff2');unicode-range:U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;}@font-face{font-family:'Montserrat';font-style:italic;font-weight:500;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUPjIg1_i6t8kCHKm459WxZOg3z-PZwjimrq1Q_.woff2) format('woff2');unicode-range:U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;}@font-face{font-family:'Montserrat';font-style:italic;font-weight:500;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUPjIg1_i6t8kCHKm459WxZOg3z8_Zwjimrq1Q_.woff2) format('woff2');unicode-range:U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;}@font-face{font-family:'Montserrat';font-style:italic;font-weight:500;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUPjIg1_i6t8kCHKm459WxZOg3z8vZwjimrq1Q_.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}@font-face{font-family:'Montserrat';font-style:italic;font-weight:500;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUPjIg1_i6t8kCHKm459WxZOg3z_PZwjimrqw.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}@font-face{font-family:'Montserrat';font-style:italic;font-weight:600;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUPjIg1_i6t8kCHKm459WxZFgrz8fZwjimrq1Q_.woff2) format('woff2');unicode-range:U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;}@font-face{font-family:'Montserrat';font-style:italic;font-weight:600;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUPjIg1_i6t8kCHKm459WxZFgrz-PZwjimrq1Q_.woff2) format('woff2');unicode-range:U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;}@font-face{font-family:'Montserrat';font-style:italic;font-weight:600;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUPjIg1_i6t8kCHKm459WxZFgrz8_Zwjimrq1Q_.woff2) format('woff2');unicode-range:U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;}@font-face{font-family:'Montserrat';font-style:italic;font-weight:600;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUPjIg1_i6t8kCHKm459WxZFgrz8vZwjimrq1Q_.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}@font-face{font-family:'Montserrat';font-style:italic;font-weight:600;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUPjIg1_i6t8kCHKm459WxZFgrz_PZwjimrqw.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:300;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_cJD3gTD_vx3rCubqg.woff2) format('woff2');unicode-range:U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:300;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_cJD3g3D_vx3rCubqg.woff2) format('woff2');unicode-range:U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:300;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_cJD3gbD_vx3rCubqg.woff2) format('woff2');unicode-range:U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:300;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_cJD3gfD_vx3rCubqg.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:300;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_cJD3gnD_vx3rCs.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:400;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUSjIg1_i6t8kCHKm459WRhyyTh89ZNpQ.woff2) format('woff2');unicode-range:U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:400;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUSjIg1_i6t8kCHKm459W1hyyTh89ZNpQ.woff2) format('woff2');unicode-range:U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:400;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUSjIg1_i6t8kCHKm459WZhyyTh89ZNpQ.woff2) format('woff2');unicode-range:U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:400;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUSjIg1_i6t8kCHKm459WdhyyTh89ZNpQ.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:400;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTUSjIg1_i6t8kCHKm459WlhyyTh89Y.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:500;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_ZpC3gTD_vx3rCubqg.woff2) format('woff2');unicode-range:U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:500;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_ZpC3g3D_vx3rCubqg.woff2) format('woff2');unicode-range:U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:500;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_ZpC3gbD_vx3rCubqg.woff2) format('woff2');unicode-range:U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:500;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_ZpC3gfD_vx3rCubqg.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:500;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_ZpC3gnD_vx3rCs.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:600;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_bZF3gTD_vx3rCubqg.woff2) format('woff2');unicode-range:U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:600;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_bZF3g3D_vx3rCubqg.woff2) format('woff2');unicode-range:U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:600;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_bZF3gbD_vx3rCubqg.woff2) format('woff2');unicode-range:U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:600;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_bZF3gfD_vx3rCubqg.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}@font-face{font-family:'Montserrat';font-style:normal;font-weight:600;src:url(https://fonts.gstatic.com/s/montserrat/v15/JTURjIg1_i6t8kCHKm45_bZF3gnD_vx3rCs.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
    .bs-stepper .bs-stepper-header .step.active .step-trigger .bs-stepper-label .bs-stepper-title {
    color: #7367f0;
    }
    .bs-stepper .bs-stepper-header .step .step-trigger .bs-stepper-label .bs-stepper-title {
    display: inherit;
    color: #151515;
    font-weight: 600;
    line-height: 1rem;
    margin-bottom: 0;
    }
    .bs-stepper .bs-stepper-header .step:first-child .step-trigger {
    padding-left: 0;
    }
    .bs-stepper .bs-stepper-header .step .step-trigger {
        padding: 0 1.75rem;
        flex-wrap: nowrap;
        font-weight: 400;
    }
    .bs-stepper .step-trigger:not(:disabled):not(.disabled) {
        /* cursor: pointer; */
    }
    .bs-stepper .step-trigger {
        display: inline-flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        padding: 20px;
        font-size: 1rem;
        font-weight: 700;
        line-height: 1.5;
        color: #6c757d;
        text-align: center;
        text-decoration: none;
        white-space: nowrap;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        background-color: transparent;
        border: none;
        border-radius: .25rem;
        transition: background-color .15s ease-out,color .15s ease-out;
    }
    .bs-stepper .bs-stepper-header .step.active .step-trigger .bs-stepper-box {
        background-color: #7367f0;
        color: #fff;
        box-shadow: 0 3px 6px 0 rgb(115 103 240 / 40%);
    }
    .bs-stepper .bs-stepper-header .step .step-trigger .bs-stepper-box {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        padding: .5em 0;
        font-weight: 500;
        color: #babfc7;
        background-color: rgba(186,191,199,.12);
        border-radius: .35rem;
    }
    .bs-stepper .bs-stepper-header .step .step-trigger .bs-stepper-label {
        text-align: left;
        margin: .5rem 0 0 1rem;
    }
    .bs-stepper .bs-stepper-header .step .step-trigger {
        padding: 0 1.75rem;
        flex-wrap: nowrap;
        font-weight: 400;
    }
    .bs-stepper .step-trigger:not(:disabled):not(.disabled) {
        /* cursor: pointer; */
    }
    .bs-stepper.wizard-modern {
        background-color: transparent;
        box-shadow: none;
    }
    .bs-stepper {
        background-color: #fff;
        box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%);
        border-radius: .5rem;
    }
    .horizontal-wizard, .modern-horizontal-wizard, .modern-vertical-wizard, .vertical-wizard {
        margin-bottom: 2.2rem;
    }

    .ml-auto, .mx-auto {
        margin-left: auto!important;
    }
    .mr-auto, .mx-auto {
        margin-right: auto!important;
    }
    .w-75 {
        width: 75%!important;
    }
    article, aside, figcaption, figure, footer, header, hgroup, main, nav, section {
        display: block;
    }
    .bs-stepper.wizard-modern {
        background-color: transparent;
        box-shadow: none;
    }
    .bs-stepper {
        background-color: #fff;
        box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%);
        border-radius: .5rem;
    }
    .bs-stepper.wizard-modern .bs-stepper-header {
        border: none;
    }
    .bs-stepper .bs-stepper-header {
        padding: 1.5rem;
        flex-wrap: wrap;
        border-bottom: 1px solid rgba(34,41,47,.08);
        margin: 0;
    }
    .bs-stepper-header {
        display: flex;
        align-items: center;
    }
    .bs-stepper .bs-stepper-header .step.active .step-trigger .bs-stepper-label .bs-stepper-title {
        color: #7367f0;
    }
    .bs-stepper .bs-stepper-header .step .step-trigger .bs-stepper-label .bs-stepper-title {
        display: inherit;
        color: #151515;
        font-weight: 600;
        line-height: 1rem;
        margin-bottom: 0;
    }
    .bs-stepper .bs-stepper-header .step .step-trigger .bs-stepper-label .bs-stepper-subtitle {
        font-weight: 400;
        font-size: .85rem;
        color: #626271;
    }
    .bs-stepper .bs-stepper-header .line {
        flex: 0;
        min-width: auto;
        min-height: auto;
        background-color: transparent;
        margin: 0;
        color: #151515;
        font-size: 1.5rem;
    }
    .bs-stepper.wizard-modern .bs-stepper-content {
        background-color: #fff;
        border-radius: .5rem;
        box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%);
    }
    .bs-stepper .bs-stepper-content {
        padding: 1.5rem;
    }
    .bs-stepper-pane.fade.active, .bs-stepper .content.fade.active {
        visibility: visible;
        opacity: 1;
    }
    .bs-stepper .bs-stepper-content .content {
        margin-left: 0;
    }
    .bs-stepper-pane.dstepper-block, .bs-stepper .content.dstepper-block {
        display: block;
    }
    .bs-stepper-pane.fade, .bs-stepper .content.fade {
        /* visibility: hidden; */
        transition-duration: .3s;
        transition-property: opacity;
    }
    .mb-0, .my-0 {
        margin-bottom: 0!important;
    }
    .h5, h5 {
        font-size: 1.07rem;
    }
    .text-muted {
        color: #626271!important;
    }
    .small, small {
        font-size: .857rem;
        font-weight: 400;
    }
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -1rem;
        margin-left: -1rem;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    label {
        color: #151515;
        font-size: .857rem;
    }
    label {
        display: inline-block;
        margin-bottom: .2857rem;
    }
    .form-control {
        display: block;
        width: 100%;
        height: 2.714rem;
        padding: .438rem 1rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.45;
        color: #151515;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #d8d6de;
        border-radius: .357rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .ng-select {
        display: block;
        position: relative;
    }
    fieldset {
        min-width: 0;
        padding: 0;
        margin: 0;
        border: 0;
    }
    .custom-file-input {
        z-index: 2;
        margin: 0;
        opacity: 0;
    }

    .custom-file, .custom-file-input {
        position: relative;
        width: 100%;
        height: 2.714rem;
        cursor: pointer;
    }
    .custom-file-label {
        line-height: 1.75;
        height: 2.714rem!important;
    }

    .custom-control-label:before, .custom-file-label, .custom-select {
        transition: background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,background 0s,border-color 0s;
    }
    .custom-file-label, .custom-file-label:after {
        position: absolute;
        top: 0;
        right: 0;
        height: 2.714rem;
        padding: .438rem 1rem;
        line-height: 1.45;
        color: #151515;
        background-color: #fff;
    }
    .custom-file-label {
        left: 0;
        z-index: 1;
        font-weight: 400;
        border: 1px solid #d8d6de;
        border-radius: .357rem;
    }
    .bs-stepper:not(.vertical) .bs-stepper-pane.dstepper-none, .bs-stepper:not(.vertical) .content.dstepper-none {
        display: none;
    }

    .bs-stepper .bs-stepper-content .content {
        margin-left: 0;
    }
    .bs-stepper-pane.fade, .bs-stepper .content.fade {
        visibility: hidden;
        transition-duration: .3s;
        transition-property: opacity;
    }
    html .blank-page .content {
        margin-left: 0;
    }
    .fade:not(.show) {
        opacity: 0;
    }
    .highlight {
        position:inherit !important;
        color:red;
    }
    #toast-container .toast-success{
        background-color: #28c76f!important;
    }
    #toast-container .toast-error{
        background-color: #ea5455!important;
    }
    #profile_img
    {
        display: none;
    }
    #choose_file
    {
        display: none;
    }
    #profileimg
    {
        cursor: pointer;
    }
    .profile-img {
        width: 150px;
        height: 150px;
        overflow: hidden;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        -o-border-radius: 50%;
        border-radius: 50%;
    }
    .profile-img img {
        width: 150px;
        height: 150px;
    }
    *{
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    }
    .black{
        color: red;
    }
    .select2-selection__clear{
        display:none;
    }
    #toast-container .toast-success {
        background-color: #28c76f !important;
    }
    #toast-container .toast-error {
        background-color: #ea5455 !important;
    }
</style>
@endpush

@section('content')
@php $states = \App\Models\State::get(); @endphp
@php $cities = \App\Models\Cities::get(); @endphp
<section class="modern-horizontal-wizard w-75 mx-auto">
    <div id="stepper3" class="bs-stepper wizard-modern modern-wizard-example">
        <div class="bs-stepper-header">
            <div class="step step4 active" data-target="#personal-details-modern">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">
                        <i data-feather="file-text" class="font-medium-3"></i>
                    </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Personal Details</span>
                        <span class="bs-stepper-subtitle">Setup Personal Details</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            <div class="step step1" data-target="#account-details-modern">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">
                        <i data-feather="file-text" class="font-medium-3"></i>
                    </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Basic Details</span>
                        <span class="bs-stepper-subtitle">Setup Profile Details</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            <div class="step step2" data-target="#personal-info-modern">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">
                        <i data-feather="user" class="font-medium-3"></i>
                    </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Professional Info</span>
                        <span class="bs-stepper-subtitle">Add Work Info</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            <div class="step step3" data-target="#address-step-modern">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">
                        <i data-feather="map-pin" class="font-medium-3"></i>
                    </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Address</span>
                        <span class="bs-stepper-subtitle">Add Address</span>
                    </span>
                </button>
            </div>
        </div>
        <div class="bs-stepper-content">
            <form class="registerSave" id="registerSave" action="{{route('registerDetails')}}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div id="personal-details-modern" class="content fade active dstepper-block">
                <div class="content-header">
                    <!-- <h5 class="mb-0">Personal Details</h5>
                    <small class="text-muted">Enter Your Details.</small> -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Personal Details</h4>
                    </div> 
                    <div class="col-lg-3">
                        <fieldset class="form-group">
                            <label for="file-upload-single" style="font-size:12px!important;">Upload Profile photo</label>
                            <div class="custom-file">
                                <input type="file" name="profile_img" id="profile_img" class="custom-file-input file-input3" ng2FileSelect
                                    [uploader]="uploader" id="file-upload-single"  value='{{request()->profile_img}}' />
                                <!-- <label class="custom-file-label file-label3">Choose file</label> -->
                                <span class="highlight">{{$errors->first('profile_img')}}</span>
                            </div>
                            <div class="profile-img">
							    <img src="{{url('partner-assets/app-assets/images/avatars/profile.png')}}" class="round img-fluid" id="profileimg" name="profileimg" width="100" alt="Card image">	
						    </div>
                            <p class="black" id="profile_img_error">Allowed Extensions are : *.jpg, *.jpeg, *.png</p>
                        </fieldset>
                    </div>
                    <div class="col-lg-9" style="margin-top:5%">
                        <input type="hidden" id="email" name="email" class="form-control" value="{{ Session::get('email') }}"/>
                        <div class="form-group col-md-12">
                            <label class="form-label" for="firstname" style="font-size: 20px!important;">Name<span class="required"> * </span></label>
                            <p style="color:#151515"><i>If you own a business, please enter your Business Name. Freelancers may write their own name they wish to display in the profile.​</i></p>
                            <input type="text" autocomplete="off" id="company" value="{{request()->company}}" name="company" class="form-control" placeholder="" required/>
                            <span class="highlight">{{$errors->first('firstname')}}</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <!-- <button type="button" class="btn btn-outline-secondary btn-prev" disabled  >
                        <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button> -->
                    <button type="button"  class="btn btn-primary btn-next " id='next1' style="right: -90%;">
                        <span class="align-middle d-sm-inline-block d-none" >Next</span>
                        <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                    </button>
                </div>
                <br>
                <p class="black" id="black1">Please fill all the <span class="required"> * </span> marked fields.</p>
            </div>
            <div id="account-details-modern" class="content fade dstepper-none">
                <div class="content-header">
                    <h5 class="mb-0">Basic Details</h5>
                    <small class="text-muted">Enter Your Details.</small>
                </div>
                <div class="row">
                    <div class="form-group form-password-toggle col-md-12">
                        <label class="form-label" for="id_proof">Select Govt ID Proof<span class="required"> * </span></label>
                        <select class="floating-select select2 form-control form-control dt-input dt-full-name" data-column="1" placeholder="Select ID Proof" placeholder="Alaric Beslier" data-column-index="0" value="" name="id_proof" id="id_proof">
                            <option value="">Select</option>   
                            <option value="aadhar" {{request()->id_proof=='aadhar'?'selected="selected"':''}}>Aadhar Card</option>
                            <option value="pan" {{request()->id_proof=='pan'?'selected="selected"':''}}>PAN Card</option>
                            <option value="driving" {{request()->id_proof=='driving'?'selected="selected"':''}}>Driving License</option>
                            <option value="passport" {{request()->id_proof=='passport'?'selected="selected"':''}}>Passport</option>
                            <option value="other" {{request()->id_proof=='other'?'selected="selected"':''}}>Other Government Id</option>
                        </select>
                        <span class="highlight">{{$errors->first('id_proof')}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Select files</h4>
                    </div>
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label for="file-upload-single">Front Photo:<span class="required"> * </span></label>
                            <div class="custom-file">
                                <input type="file" name="front_img" id="front_img" class="custom-file-input file-input1" accept="application/pdf,image/jpeg,image/png" ng2FileSelect
                                    [uploader]="uploader" id="file-upload-single" value='{{request()->front_img}}' />
                                <label class="custom-file-label file-label1"  id="choose_file1">Choose file</label>
                                <span class="highlight">{{$errors->first('front_img')}}</span>
                            </div>
                            <p class="black" id="proof_error1">Allowed Extensions are : *.jpg, *.jpeg, *.png</p>
                        </fieldset>                        
                    </div>                    
                    <div class="col-lg-4">
                        <fieldset class="form-group">
                            <label for="file-upload-single">Back Photo:<span class="required"> * </span></label>
                            <div class="custom-file">
                                <input type="file" name="back_img" id="back_img" class="custom-file-input file-input2" accept="application/pdf,image/jpeg,image/png" ng2FileSelect
                                    [uploader]="uploader" id="file-upload-single" value='{{request()->back_img}}' />
                                <label class="custom-file-label file-label2"  id="choose_file2">Choose file</label>
                                <span class="highlight">{{$errors->first('back_img')}}</span>
                            </div>
                            <p class="black" id="proof_error2">Allowed Extensions are : *.jpg, *.jpeg, *.png</p>
                        </fieldset>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary btn-prev" id='pre4' >
                        <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button type="button"  class="btn btn-primary btn-next " id='next2' >
                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                        <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                    </button>
                </div>
                <br>
                <p class="black" id="black2">Please fill all the <span class="required"> * </span> marked fields.</p>
                <p class="black" id="proof_error">Allowed Extensions are : *.jpg, *.jpeg, *.png</p>
            </div>
            <div id="personal-info-modern" class="content fade dstepper-none">
                <div class="content-header">
                    <h5 class="mb-0">Professional Info</h5>
                    <small>Enter Your Professional Info.</small>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-md-8">
                        <label class="form-label" for="projects_done">Number of Projects done ?<span class="required"> * </span></label>
                        <input type="number" autocomplete="off" onkeyup="if(this.value<0){this.value= this.value * -1}"  id="projects_done" value="{{request()->projects_done}}" name="projects_done" class="form-control" placeholder="" />
                        <span class="highlight">{{$errors->first('projects_done')}}</span>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-md-8">
                        <label class="form-label" for="category">Select what services you would offer at UBID?<span class="required"> * </span>(<code>Note : You can add Multiple services that defines you.</code>)</label>
                        <select class="floating-select select2 form-control category-select" placeholder="Primary Services" value="" name="category[]" id="category" multiple="multiple">
                            <option value="">Select Category</option>
                            @php $categories = App\Models\Category::where('status',1)->whereNull('deleted_at')->orderBy('name','asc')->get(); @endphp
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <span class="highlight">{{$errors->first('category')}}</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary btn-prev" id='pre1'   >
                        <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button type="button" class="btn btn-primary btn-next" id='next3'   >
                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                        <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                    </button>
                </div>
                <br>
                <p class="black" id="black3">Please fill all the <span class="required"> * </span> marked fields.</p>
            </div>
            <div id="address-step-modern" class="content fade dstepper-none">
                <div class="content-header">
                    <h5 class="mb-0">Address</h5>
                    <small>Enter Your Address.</small>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="form-label mr-2" for="modern-address">Address Type :<span class="required"> * </span></label>
                                <div class="form-check form-check-inline mr-2">
                                    <input class="form-check-input" type="radio" name="adtype"
                                        id="adtype_home" value="home" checked />
                                    <label class="form-check-label" for="adtype_home">Home</label>
                                </div>
                                <div class="form-check form-check-inline mr-2">
                                    <input class="form-check-input" type="radio" name="adtype"
                                        id="adtype_office" value="office" checked />
                                    <label class="form-check-label" for="adtype_office">Office</label>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-label mr-2" for="address1">Address Line 1:<span class="required"> * </span></label>
                                <!-- <fieldset class="form-group">
                                    <textarea class="form-control" id="basicTextarea" rows="3"
                                        placeholder="Enter the address where customers can fnd you"></textarea>
                                </fieldset> -->
                                <input type="text" id="address1" value="{{request()->address1}}" autocomplete="off" name="address1" class="form-control" placeholder="" required/>
                                <span class="highlight">{{$errors->first('address1')}}</span>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-label mr-2" for="address2">Address Line 2 :</label>
                                <input type="text" id="address2" value="{{request()->address2}}"  autocomplete="off" name="address2"class="form-control" placeholder="" />
                                <span class="highlight">{{$errors->first('address2')}}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label mr-2" for="state">State :<span class="required"> * </span></label>
                                <select class="floating-select select2 form-control form-control dt-input dt-full-name" name="state" id="state" required>
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                    @endforeach
                                </select>
                                <span class="highlight">{{$errors->first('state')}}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label mr-2" for="city">City :<span class="required"> * </span></label>
                                <select class="floating-select select2 form-control form-control dt-input dt-full-name" name="city" id="city" required disabled>
                                </select>
                                <span class="highlight">{{$errors->first('city')}}</span>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="form-label mr-2" for="pincode">Pincode :<span class="required"> * </span></label>
                                <input type="number" id="pincode" value="{{request()->pincode}}" maxlength="6" oninput="this.value=this.value.slice(0,this.maxLength)" autocomplete="off" name="pincode" class="form-control" placeholder="" required />
                                <span class="highlight">{{$errors->first('pincode')}}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label mr-2" for="landmark">Landmark :</label>
                                <input type="text" id="landmark" value="{{request()->landmark}}"  autocomplete="off" name="landmark" class="form-control" placeholder="" />
                                <span class="highlight">{{$errors->first('landmark')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label mr-2" for="modern-address">Locate on Map :</label>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d487293.2774677608!2d78.12784000692413!3d17.412808363619543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb99daeaebd2c7%3A0xae93b78392bafbc2!2sHyderabad%2C%20Telangana!5e0!3m2!1sen!2sin!4v1628189355642!5m2!1sen!2sin" width="100%" height="400px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center">
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary btn-prev" id='pre2'>
                        <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button type="submit" name="registserSubmit" id="registserSubmit" value="registserSubmit" class="btn btn-success btn-submit"  >Submit</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>
@stop

@push('PAGE_ASSETS_JS')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgjNW0WA93qphgZW-joXVR6VC3IiYFjfo"></script>
@endpush

@push('PAGE_SCRIPTS')
<script>

$('.file-input1').on('change', function(e) {
    var extension = e.target.files[0].name.split('.').pop().toLowerCase()
    var reader = new FileReader();
    reader.onload = function(e) {
        if (extension == 'jpg' || extension == 'jpeg' || extension == 'png') {
            $("#proof_error1").css("display", "none");
            return true;        
        }
        else{
            $("#proof_error1").css("display", "block");
            return false;
            
        }
    }
    reader.readAsDataURL(e.target.files[0]);
});

$('.file-input2').on('change', function(e) {
    var extension = e.target.files[0].name.split('.').pop().toLowerCase()
    var reader = new FileReader();
    reader.onload = function(e) {
        if (extension == 'jpg' || extension == 'jpeg' || extension == 'png') {
            $("#proof_error2").css("display", "none");
            return true;        
        }
        else{
            $("#proof_error2").css("display", "block");
            return false;
            
        }
    }
    reader.readAsDataURL(e.target.files[0]);
});

$('.file-input3').on('change', function(e) {
    var extension = e.target.files[0].name.split('.').pop().toLowerCase()
    var reader = new FileReader();
    reader.onload = function(e) {
        if (extension == 'jpg' || extension == 'jpeg' || extension == 'png') {
            $('#profileimg').attr('src', reader.result);
            $("#profile_img_error").css("display", "none");
        }
        else{
            $("#profile_img_error").css("display", "block");
            $('#profileimg').attr('src', 'partner-assets/app-assets/images/avatars/profile.png');
            return false;
        }
    }
    reader.readAsDataURL(e.target.files[0]);
});

    $('#state').on('change', function() {
    
        var state_id = this.value;
        // alert(state_id);
        $("#city").html('');
        $.ajax({
        url:"{{route('getcitiesbystate')}}",
        type: "POST",
        data: {
        state_id: state_id,
        _token: '{{csrf_token()}}' 
        },
        dataType : 'json',
            success: function(result){
            document.getElementById("city").disabled = false;
            $('#city').html('<option value="">Select City</option>'); 
                $.each(result.cities,function(key,value){
                $("#city").append('<option value="'+value.id+'">'+value.name+'</option>');
                });
            }
        });
    });

    $("#next2").on("click", function(e) {
        e.preventDefault();

        if (isValid2()) {

                var allowedExtension = ['jpeg', 'jpg', 'png'];
                var fileExtension1 = document.getElementById('front_img').value.split('.').pop().toLowerCase();
                var fileExtension2 = document.getElementById('back_img').value.split('.').pop().toLowerCase();
                var isValidFile = false;

                    for(var index in allowedExtension) {

                        if((fileExtension1 === allowedExtension[index]) || (fileExtension2 === allowedExtension[index])) {
                            isValidFile = true; 
                            $("#proof_error").css("display", "none");
                            $('.step1').removeClass('active');
                            $('#account-details-modern').removeClass('active');
                            $('#account-details-modern').removeClass('dstepper-block');
                            $('#account-details-modern').addClass('dstepper-none');
                            $('.step2').addClass('active');
                            $('#personal-info-modern').addClass('active');
                            $('#personal-info-modern').removeClass('dstepper-none');
                            $('#personal-info-modern').addClass('dstepper-block');
                            $('.step3').removeClass('active');
                            $('#address-step-modern').removeClass('active');
                            $('#address-step-modern').removeClass('dstepper-block');
                            $('#address-step-modern').addClass('dstepper-none');
                            break;
                        }
                    }
                    if(!isValidFile) {
                        $("#proof_error").css("display", "block");
                        return false;
                    }
            }
        else{
            $("#black2").css("display", "block");
        }
        });

        function isValid2() {
        
        var text1 = $("#id_proof").val();
        var text2 = $("#front_img").val();
        var text3 = $("#back_img").val();
        // alert(text3);
        if (text1.length == 0 || text2.length == 0 || text3.length == 0) {
            return false;
        }
        return true;
        }

    $("#next1").on("click", function(e) {
        e.preventDefault();

        if (isValid1()) {

            // var allowedExtension = ['jpeg', 'jpg', 'png'];
            // var fileExtension1 = document.getElementById('front_img').value.split('.').pop().toLowerCase();
            // var fileExtension2 = document.getElementById('back_img').value.split('.').pop().toLowerCase();
            // var isValidFile = false;

            $("#black").css("display", "none");
            $("#profile_img_error").css("display", "none");
            $('.step4').removeClass('active');
            $('#personal-details-modern').removeClass('active');
            $('#personal-details-modern').removeClass('dstepper-block');
            $('#personal-details-modern').addClass('dstepper-none');
            $('.step1').addClass('active');
            $('#account-details-modern').addClass('active');
            $('#account-details-modern').addClass('dstepper-block');
            $('#account-details-modern').removeClass('dstepper-none');
            $('.step2').removeClass('active');
            $('#personal-info-modern').removeClass('active');
            $('#personal-info-modern').addClass('dstepper-none');
            $('#personal-info-modern').removeClass('dstepper-block');
            $('.step3').removeClass('active');
            $('#address-step-modern').removeClass('active');
            $('#address-step-modern').removeClass('dstepper-block');
            $('#address-step-modern').addClass('dstepper-none');
            }
        else{
            $("#black1").css("display", "block");
        }
        });

        function isValid1() {
        var text = $("#company").val();
        if (text.length == 0) {
            return false;
        }
        return true;
        }

    $("#next3").on("click", function(e) {
        e.preventDefault();

        if (isValid3()) {
            $("#black").css("display", "none");
            $("#proof_error").css("display", "none");
            $('.step1').removeClass('active');
            $('#account-details-modern').removeClass('active');
            $('#account-details-modern').removeClass('dstepper-block');
            $('#account-details-modern').addClass('dstepper-none');
            $('.step2').removeClass('active');
            $('#personal-info-modern').removeClass('active');
            $('#personal-info-modern').removeClass('dstepper-block');
            $('#personal-info-modern').addClass('dstepper-none');
            $('.step3').addClass('active');
            $('#address-step-modern').addClass('active');
            $('#address-step-modern').removeClass('dstepper-none');
            $('#address-step-modern').addClass('dstepper-block');
            }
        else{
            $("#black3").css("display", "block");
        }
        });

    function isValid3() {
        var text1 = $("#projects_done").val();
        var text2 = $(".category-select").val();
        // alert($(".category-select").val());
        if (text1.length == 0 || text2.length == 0) {
            return false;
        }
        return true;
        }
    
    $("#pre1").on("click", function(e) {
        e.preventDefault();
        $('.step1').addClass('active');
        $('#account-details-modern').addClass('active');
        $('#account-details-modern').removeClass('dstepper-none');
        $('#account-details-modern').addClass('dstepper-block');
        $('.step2').removeClass('active');
        $('#personal-info-modern').removeClass('active');
        $('#personal-info-modern').removeClass('dstepper-block');
        $('#personal-info-modern').addClass('dstepper-none');
        $('.step3').removeClass('active');
        $('#address-step-modern').removeClass('active');
        $('#address-step-modern').removeClass('dstepper-block');
	});

    $("#pre4").on("click", function(e) {
        e.preventDefault();
        $('.step4').addClass('active');
        $('#personal-details-modern').addClass('active');
        $('#personal-details-modern').removeClass('dstepper-none');
        $('#personal-details-modern').addClass('dstepper-block');
        $('.step1').removeClass('active');
        $('#account-details-modern').removeClass('active');
        $('#account-details-modern').addClass('dstepper-none');
        $('#account-details-modern').removeClass('dstepper-block');
        $('.step2').removeClass('active');
        $('#personal-info-modern').removeClass('active');
        $('#personal-info-modern').removeClass('dstepper-block');
        $('#personal-info-modern').addClass('dstepper-none');
        $('.step3').removeClass('active');
        $('#address-step-modern').removeClass('active');
        $('#address-step-modern').removeClass('dstepper-block');
	});

    $("#pre2").on("click", function(e) {
        e.preventDefault();
        $('.step1').removeClass('active');
        $('#account-details-modern').removeClass('active');
        $('#account-details-modern').removeClass('dstepper-block');
        $('#account-details-modern').addClass('dstepper-none');
        $('.step2').addClass('active');
        $('#personal-info-modern').addClass('active');
        $('#personal-info-modern').removeClass('dstepper-none');
        $('#personal-info-modern').addClass('dstepper-block');
        $('.step3').removeClass('active');
        $('#address-step-modern').removeClass('active');
        $('#address-step-modern').removeClass('dstepper-block');
        $('#address-step-modern').addClass('dstepper-none');
    });

    $("#profileimg").click(function(e) {
        $("#profile_img").click();

    });

    function fasterPreview( uploader ) {
        if ( uploader.files && uploader.files[0] ){
            $('#profileimg').attr('src', 
                window.URL.createObjectURL(uploader.files[0]) );
        }
    }

$("#profile_img").change(function(){
    fasterPreview( this );
});
// $("profile_img").on("change",function(){
//     readURL(this,"#profileimg")
// });
</script>
<script type="text/javascript">
var Register = function () {
    return { //main function to initiate the module
        init: function () {

            $("#black1").css("display", "none");
            $("#black2").css("display", "none");
            $("#black3").css("display", "none");
            $("#black4").css("display", "none");
            $("#profile_img_error").css("display", "none");
            $("#proof_error1").css("display", "none");
            $("#proof_error").css("display", "none");
            $("#proof_error2").css("display", "none");

            $('body').on('change', '.file-input1', function(e) {
                var fileName1 = e.target.files[0].name;
                // alert(fileName);
                $('.file-label1').text(fileName1);
            });
            $('body').on('change', '.file-input2', function(e) {
                var fileName2 = e.target.files[0].name;
                // alert(fileName);
                $('.file-label2').text(fileName2);
            });
            $('body').on('change', '.file-input3', function(e) {
                var fileName3 = e.target.files[0].name;
                // alert(fileName);
                $('.file-label3').text(fileName3);
            });
        }
    }
}();

jQuery(document).ready(function() {
    Register.init();
});
</script>
@endpush