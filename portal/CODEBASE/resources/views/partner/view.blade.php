@extends('layouts.app')

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
    cursor: pointer;
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
    cursor: pointer;
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
    color: #626271;
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

<style>
.bs-stepper .bs-stepper-content .content {
    margin-left: 0;
}
<style>
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
</style>
@endpush

@section('content')
@php $states = \App\Models\State::get(); @endphp

<!-- @php echo env('APP_URL'); @endphp -->
<section class="modern-horizontal-wizard w-75 mx-auto">
    <div id="stepper3" class="bs-stepper wizard-modern modern-wizard-example">
        <div class="bs-stepper-header">
            <div class="step step1 active" data-target="#account-details-modern">
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
            <div id="account-details-modern" class="content fade active dstepper-block">
                <div class="content-header">
                    <h5 class="mb-0">Basic Details</h5>
                    <small class="text-muted">Enter Your Details.</small>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="form-label" for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" value="{{$vendor->first_name}}" class="form-control" placeholder="Enter your First Name" readonly/>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="lastname">Last name</label>
                        <input type="text" id="lastname" name="lastname" value="{{$vendor->last_name}}" class="form-control" placeholder="Enter your Last Name" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group form-password-toggle col-md-12">
                        <label class="form-label" for="id_proof">Select Govt ID Proof</label>
                        <select class="floating-select select2 form-control form-control dt-input dt-full-name" data-column="1" placeholder="Primary Category" placeholder="Alaric Beslier" data-column-index="0" value="" name="id_proof" id="id_proof" readonly>
                            <option value="">Select</option>   
                            <option value="aadhar" {{$vendor->id_proof=='aadhar'?'selected="selected"':''}}>Aadhar Card</option>
                                <option value="pan" {{$vendor->id_proof=='pan'?'selected="selected"':''}}>PAN Card</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <h4>Select files</h4>
                        <fieldset class="form-group">
                            <label for="file-upload-single">Front Photo:</label>
                            <div class="custom-file">
                                <input type="file" name="front_img" id="front_img" class="custom-file-input file-input1" type="file" ng2FileSelect
                                    [uploader]="uploader" id="file-upload-single" />
                                <label class="custom-file-label file-label1">Choose file</label>
                            </div>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="file-upload-single">Back Photo:</label>
                            <div class="custom-file">
                                <input type="file" name="back_img" id="back_img" class="custom-file-input file-input2" type="file" ng2FileSelect
                                    [uploader]="uploader" id="file-upload-single" />
                                <label class="custom-file-label file-label2">Choose file</label>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-outline-secondary btn-prev" disabled rippleEffect>
                        <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button class="btn btn-primary btn-next" (click)="#personal-info-modern" rippleEffect>
                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                        <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                    </button>
                </div>
            </div>
            <div id="personal-info-modern" class="content fade dstepper-none">
                <div class="content-header">
                    <h5 class="mb-0">Personal Info</h5>
                    <small>Enter Your Personal Info.</small>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-md-8">
                        <label class="form-label" for="projects_done">Number of Projects done?</label>
                        <input type="text" id="projects_done" value="{{$vendor->projects_done}}" name="projects_done" class="form-control" placeholder="" readonly/>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-md-8">
                        <label class="form-label" for="modern-country">Select what defines you ?</label><br>
                        <code>Note : You can add Multiple services that defines you.</code>
                        <div class="custom-control custom-checkbox my-1">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" checked />
                            <label class="custom-control-label" for="customCheck1">Interior designer</label>
                        </div>
                        <div class="custom-control custom-checkbox my-1">
                            <input type="checkbox" class="custom-control-input" id="customCheck2" checked />
                            <label class="custom-control-label" for="customCheck2">Architect</label>
                        </div>
                        <div class="custom-control custom-checkbox my-1">
                            <input type="checkbox" class="custom-control-input" id="customCheck3" />
                            <label class="custom-control-label" for="customCheck3">Freelancer</label>
                        </div>
                        <div class="custom-control custom-checkbox my-1">
                            <input type="checkbox" class="custom-control-input" id="customCheck4" checked />
                            <label class="custom-control-label" for="customCheck4">3D Visualization Expert</label>
                        </div>
                        <div class="custom-control custom-checkbox my-1">
                            <input type="checkbox" class="custom-control-input" id="customCheck5" />
                            <label class="custom-control-label" for="customCheck5">Home Decor Supplier</label>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary btn-prev" (click)="modernHorizontalPrevious()" rippleEffect>
                        <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button class="btn btn-primary btn-next" (click)="modernHorizontalNext()" rippleEffect>
                        <span class="align-middle d-sm-inline-block d-none">Next</span>
                        <i data-feather="arrow-right" class="align-middle ml-sm-25 ml-0"></i>
                    </button>
                </div>
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
                                <label class="form-label" for="company">Company Name</label>
                                <input type="text" id="company" value="{{$vendor->company}}" name="company" class="form-control" placeholder="" readonly/>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-label mr-2" for="modern-address">Address Type :</label>
                                <div class="form-check form-check-inline mr-2">
                                    <input class="form-check-input" type="radio" name="adtype"
                                        id="adtype_home" value="home" checked readonly/>
                                    <label class="form-check-label" for="adtype_home">Home</label>
                                </div>
                                <div class="form-check form-check-inline mr-2">
                                    <input class="form-check-input" type="radio" name="adtype"
                                        id="adtype_office" value="office" checked readonly/>
                                    <label class="form-check-label" for="adtype_office">Office</label>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-label mr-2" for="address1">Address :</label>
                                <!-- <fieldset class="form-group">
                                    <textarea class="form-control" id="basicTextarea" rows="3"
                                        placeholder="Enter the address where customers can fnd you"></textarea>
                                </fieldset> -->
                                <input type="text" id="address1" value="{{$vendor->address1}}" name="address1" class="form-control" placeholder="" readonly/>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-label mr-2" for="address2">Address 2 :</label>
                                <input type="text" id="address2" value="{{$vendor->address2}}" name="address2"class="form-control" placeholder="" readonly/>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label mr-2" for="city">City :</label>
                                <input type="text" id="city" value="{{$vendor->city}}" name="city" class="form-control" placeholder="" readonly/>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label mr-2" for="state">State :</label>
                                <select class="form-control" name="state" id="state" readonly>
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label mr-2" for="pincode">Pincode :</label>
                                <input type="number" id="pincode" value="{{$vendor->pincode}}" name="pincode" class="form-control" placeholder="" readonly/>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label mr-2" for="landmark">Landmark :</label>
                                <input type="text" id="landmark" value="{{$vendor->landmark}}" name="landmark" class="form-control" placeholder="" readonly/>
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
                    <button class="btn btn-primary btn-prev" (click)="modernHorizontalPrevious()" rippleEffect>
                        <i data-feather="arrow-left" class="align-middle mr-sm-25 mr-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button type="submit" name="registserSubmit" id="registserSubmit" value="registserSubmit" class="btn btn-success btn-submit" rippleEffect>Submit</button>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@push('PAGE_ASSETS_JS')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgjNW0WA93qphgZW-joXVR6VC3IiYFjfo"></script>
@endpush

@push('PAGE_SCRIPTS')
<script>
    $('body').on('click', '.step2', function(e) {
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
    $('body').on('click', '.step3', function(e) {
        e.preventDefault();
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
    });
    $('body').on('click', '.step1', function(e) {
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
        $('#address-step-modern').addClass('dstepper-none');
    });
</script>
<script type="text/javascript">
var Register = function () {
    return { //main function to initiate the module
        init: function () {
            $('body').on('change', '.file-input1', function(e) {
                  var fileName = e.target.files[0].name;
                  // alert(fileName);
                  $('.file-label1').text(fileName);
               });
               $('body').on('change', '.file-input2', function(e) {
                  var fileName = e.target.files[0].name;
                  // alert(fileName);
                  $('.file-label2').text(fileName);
               });
        }
    }
}();

jQuery(document).ready(function() {
    Register.init();
});
</script>
@endpush