document.addEventListener('DOMContentLoaded', function() {
    initDataTable();
    mapInit(countriesData);
    pieChartInit();
    activeCountryChartsInit(1);
});
var table = null;
function initDataTable(){
    if (!$().DataTable) {
        console.warn('Warning - datatables.min.js is not loaded.');
        return;
    }

    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span class="me-3">Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
        }
    });

    table = new DataTable('.datatable-html',{
        columnDefs: [{
            orderable: false,
            width: 100
        }]
    });
}
function notyAlert(message, type){
    if (typeof Noty == 'undefined') {
        console.warn('Warning - noty.min.js is not loaded.');
        return;
    }

    Noty.overrideDefaults({
        theme: 'limitless',
        layout: 'center',
        type: type,
        timeout: false,
        closeWith: ['click']
    });

    new Noty({
        text: message,
        type: type,
        modal: true
    }).show();
}
var mapData = [];
function mapInit(projectScore){
    $.each(projectScore, function(index, value) {
        var tmpObj = {
            'code' : value.country_iso,
            'name' : value.country_name,
            'value' : value.number_of_records
        };

        mapData.push(tmpObj);
    })

    if (typeof echarts == 'undefined') {
        console.warn('Warning - echarts.min.js is not loaded.');
        return;
    }

    // Define element
    var map_world_scatter_element = document.getElementById('worldNumberScatter');

    // Chart configuration
    if (map_world_scatter_element) {

        var map_world_scatter = echarts.init(map_world_scatter_element, null, { renderer: 'svg' });

        var latlong = {};
        latlong.AD = {'latitude':42.5, 'longitude':1.5};
        latlong.AE = {'latitude':24, 'longitude':54};
        latlong.AF = {'latitude':33, 'longitude':65};
        latlong.AG = {'latitude':17.05, 'longitude':-61.8};
        latlong.AI = {'latitude':18.25, 'longitude':-63.1667};
        latlong.AL = {'latitude':41, 'longitude':20};
        latlong.AM = {'latitude':40, 'longitude':45};
        latlong.AN = {'latitude':12.25, 'longitude':-68.75};
        latlong.AO = {'latitude':-12.5, 'longitude':18.5};
        latlong.AP = {'latitude':35, 'longitude':105};
        latlong.AQ = {'latitude':-90, 'longitude':0};
        latlong.AR = {'latitude':-34, 'longitude':-64};
        latlong.AS = {'latitude':-14.3333, 'longitude':-170};
        latlong.AT = {'latitude':47.3333, 'longitude':13.3333};
        latlong.AU = {'latitude':-27, 'longitude':133};
        latlong.AW = {'latitude':12.5, 'longitude':-69.9667};
        latlong.AZ = {'latitude':40.5, 'longitude':47.5};
        latlong.BA = {'latitude':44, 'longitude':18};
        latlong.BB = {'latitude':13.1667, 'longitude':-59.5333};
        latlong.BD = {'latitude':24, 'longitude':90};
        latlong.BE = {'latitude':50.8333, 'longitude':4};
        latlong.BF = {'latitude':13, 'longitude':-2};
        latlong.BG = {'latitude':43, 'longitude':25};
        latlong.BH = {'latitude':26, 'longitude':50.55};
        latlong.BI = {'latitude':-3.5, 'longitude':30};
        latlong.BJ = {'latitude':9.5, 'longitude':2.25};
        latlong.BM = {'latitude':32.3333, 'longitude':-64.75};
        latlong.BN = {'latitude':4.5, 'longitude':114.6667};
        latlong.BO = {'latitude':-17, 'longitude':-65};
        latlong.BR = {'latitude':-10, 'longitude':-55};
        latlong.BS = {'latitude':24.25, 'longitude':-76};
        latlong.BT = {'latitude':27.5, 'longitude':90.5};
        latlong.BV = {'latitude':-54.4333, 'longitude':3.4};
        latlong.BW = {'latitude':-22, 'longitude':24};
        latlong.BY = {'latitude':53, 'longitude':28};
        latlong.BZ = {'latitude':17.25, 'longitude':-88.75};
        latlong.CA = {'latitude':54, 'longitude':-100};
        latlong.CC = {'latitude':-12.5, 'longitude':96.8333};
        latlong.CD = {'latitude':0, 'longitude':25};
        latlong.CF = {'latitude':7, 'longitude':21};
        latlong.CG = {'latitude':-1, 'longitude':15};
        latlong.CH = {'latitude':47, 'longitude':8};
        latlong.CI = {'latitude':8, 'longitude':-5};
        latlong.CK = {'latitude':-21.2333, 'longitude':-159.7667};
        latlong.CL = {'latitude':-30, 'longitude':-71};
        latlong.CM = {'latitude':6, 'longitude':12};
        latlong.CN = {'latitude':35, 'longitude':105};
        latlong.CO = {'latitude':4, 'longitude':-72};
        latlong.CR = {'latitude':10, 'longitude':-84};
        latlong.CU = {'latitude':21.5, 'longitude':-80};
        latlong.CV = {'latitude':16, 'longitude':-24};
        latlong.CX = {'latitude':-10.5, 'longitude':105.6667};
        latlong.CY = {'latitude':35, 'longitude':33};
        latlong.CZ = {'latitude':49.75, 'longitude':15.5};
        latlong.DE = {'latitude':51, 'longitude':9};
        latlong.DJ = {'latitude':11.5, 'longitude':43};
        latlong.DK = {'latitude':56, 'longitude':10};
        latlong.DM = {'latitude':15.4167, 'longitude':-61.3333};
        latlong.DO = {'latitude':19, 'longitude':-70.6667};
        latlong.DZ = {'latitude':28, 'longitude':3};
        latlong.EC = {'latitude':-2, 'longitude':-77.5};
        latlong.EE = {'latitude':59, 'longitude':26};
        latlong.EG = {'latitude':27, 'longitude':30};
        latlong.EH = {'latitude':24.5, 'longitude':-13};
        latlong.ER = {'latitude':15, 'longitude':39};
        latlong.ES = {'latitude':40, 'longitude':-4};
        latlong.ET = {'latitude':8, 'longitude':38};
        latlong.EU = {'latitude':47, 'longitude':8};
        latlong.FI = {'latitude':62, 'longitude':26};
        latlong.FJ = {'latitude':-18, 'longitude':175};
        latlong.FK = {'latitude':-51.75, 'longitude':-59};
        latlong.FM = {'latitude':6.9167, 'longitude':158.25};
        latlong.FO = {'latitude':62, 'longitude':-7};
        latlong.FR = {'latitude':46, 'longitude':2};
        latlong.GA = {'latitude':-1, 'longitude':11.75};
        latlong.GB = {'latitude':54, 'longitude':-2};
        latlong.GD = {'latitude':12.1167, 'longitude':-61.6667};
        latlong.GE = {'latitude':42, 'longitude':43.5};
        latlong.GF = {'latitude':4, 'longitude':-53};
        latlong.GH = {'latitude':8, 'longitude':-2};
        latlong.GI = {'latitude':36.1833, 'longitude':-5.3667};
        latlong.GL = {'latitude':72, 'longitude':-40};
        latlong.GM = {'latitude':13.4667, 'longitude':-16.5667};
        latlong.GN = {'latitude':11, 'longitude':-10};
        latlong.GP = {'latitude':16.25, 'longitude':-61.5833};
        latlong.GQ = {'latitude':2, 'longitude':10};
        latlong.GR = {'latitude':39, 'longitude':22};
        latlong.GS = {'latitude':-54.5, 'longitude':-37};
        latlong.GT = {'latitude':15.5, 'longitude':-90.25};
        latlong.GU = {'latitude':13.4667, 'longitude':144.7833};
        latlong.GW = {'latitude':12, 'longitude':-15};
        latlong.GY = {'latitude':5, 'longitude':-59};
        latlong.HK = {'latitude':22.25, 'longitude':114.1667};
        latlong.HM = {'latitude':-53.1, 'longitude':72.5167};
        latlong.HN = {'latitude':15, 'longitude':-86.5};
        latlong.HR = {'latitude':45.1667, 'longitude':15.5};
        latlong.HT = {'latitude':19, 'longitude':-72.4167};
        latlong.HU = {'latitude':47, 'longitude':20};
        latlong.ID = {'latitude':-5, 'longitude':120};
        latlong.IE = {'latitude':53, 'longitude':-8};
        latlong.IL = {'latitude':31.5, 'longitude':34.75};
        latlong.IN = {'latitude':20, 'longitude':77};
        latlong.IO = {'latitude':-6, 'longitude':71.5};
        latlong.IQ = {'latitude':33, 'longitude':44};
        latlong.IR = {'latitude':32, 'longitude':53};
        latlong.IS = {'latitude':65, 'longitude':-18};
        latlong.IT = {'latitude':42.8333, 'longitude':12.8333};
        latlong.JM = {'latitude':18.25, 'longitude':-77.5};
        latlong.JO = {'latitude':31, 'longitude':36};
        latlong.JP = {'latitude':36, 'longitude':138};
        latlong.KE = {'latitude':1, 'longitude':38};
        latlong.KG = {'latitude':41, 'longitude':75};
        latlong.KH = {'latitude':13, 'longitude':105};
        latlong.KI = {'latitude':1.4167, 'longitude':173};
        latlong.KM = {'latitude':-12.1667, 'longitude':44.25};
        latlong.KN = {'latitude':17.3333, 'longitude':-62.75};
        latlong.KP = {'latitude':40, 'longitude':127};
        latlong.KR = {'latitude':37, 'longitude':127.5};
        latlong.KW = {'latitude':29.3375, 'longitude':47.6581};
        latlong.KY = {'latitude':19.5, 'longitude':-80.5};
        latlong.KZ = {'latitude':48, 'longitude':68};
        latlong.LA = {'latitude':18, 'longitude':105};
        latlong.LB = {'latitude':33.8333, 'longitude':35.8333};
        latlong.LC = {'latitude':13.8833, 'longitude':-61.1333};
        latlong.LI = {'latitude':47.1667, 'longitude':9.5333};
        latlong.LK = {'latitude':7, 'longitude':81};
        latlong.LR = {'latitude':6.5, 'longitude':-9.5};
        latlong.LS = {'latitude':-29.5, 'longitude':28.5};
        latlong.LT = {'latitude':55, 'longitude':24};
        latlong.LU = {'latitude':49.75, 'longitude':6};
        latlong.LV = {'latitude':57, 'longitude':25};
        latlong.LY = {'latitude':25, 'longitude':17};
        latlong.MA = {'latitude':32, 'longitude':-5};
        latlong.MC = {'latitude':43.7333, 'longitude':7.4};
        latlong.MD = {'latitude':47, 'longitude':29};
        latlong.ME = {'latitude':42.5, 'longitude':19.4};
        latlong.MG = {'latitude':-20, 'longitude':47};
        latlong.MH = {'latitude':9, 'longitude':168};
        latlong.MK = {'latitude':41.8333, 'longitude':22};
        latlong.ML = {'latitude':17, 'longitude':-4};
        latlong.MM = {'latitude':22, 'longitude':98};
        latlong.MN = {'latitude':46, 'longitude':105};
        latlong.MO = {'latitude':22.1667, 'longitude':113.55};
        latlong.MP = {'latitude':15.2, 'longitude':145.75};
        latlong.MQ = {'latitude':14.6667, 'longitude':-61};
        latlong.MR = {'latitude':20, 'longitude':-12};
        latlong.MS = {'latitude':16.75, 'longitude':-62.2};
        latlong.MT = {'latitude':35.8333, 'longitude':14.5833};
        latlong.MU = {'latitude':-20.2833, 'longitude':57.55};
        latlong.MV = {'latitude':3.25, 'longitude':73};
        latlong.MW = {'latitude':-13.5, 'longitude':34};
        latlong.MX = {'latitude':23, 'longitude':-102};
        latlong.MY = {'latitude':2.5, 'longitude':112.5};
        latlong.MZ = {'latitude':-18.25, 'longitude':35};
        latlong.NA = {'latitude':-22, 'longitude':17};
        latlong.NC = {'latitude':-21.5, 'longitude':165.5};
        latlong.NE = {'latitude':16, 'longitude':8};
        latlong.NF = {'latitude':-29.0333, 'longitude':167.95};
        latlong.NG = {'latitude':10, 'longitude':8};
        latlong.NI = {'latitude':13, 'longitude':-85};
        latlong.NL = {'latitude':52.5, 'longitude':5.75};
        latlong.NO = {'latitude':62, 'longitude':10};
        latlong.NP = {'latitude':28, 'longitude':84};
        latlong.NR = {'latitude':-0.5333, 'longitude':166.9167};
        latlong.NU = {'latitude':-19.0333, 'longitude':-169.8667};
        latlong.NZ = {'latitude':-41, 'longitude':174};
        latlong.OM = {'latitude':21, 'longitude':57};
        latlong.PA = {'latitude':9, 'longitude':-80};
        latlong.PE = {'latitude':-10, 'longitude':-76};
        latlong.PF = {'latitude':-15, 'longitude':-140};
        latlong.PG = {'latitude':-6, 'longitude':147};
        latlong.PH = {'latitude':13, 'longitude':122};
        latlong.PK = {'latitude':30, 'longitude':70};
        latlong.PL = {'latitude':52, 'longitude':20};
        latlong.PM = {'latitude':46.8333, 'longitude':-56.3333};
        latlong.PR = {'latitude':18.25, 'longitude':-66.5};
        latlong.PS = {'latitude':32, 'longitude':35.25};
        latlong.PT = {'latitude':39.5, 'longitude':-8};
        latlong.PW = {'latitude':7.5, 'longitude':134.5};
        latlong.PY = {'latitude':-23, 'longitude':-58};
        latlong.QA = {'latitude':25.5, 'longitude':51.25};
        latlong.RE = {'latitude':-21.1, 'longitude':55.6};
        latlong.RO = {'latitude':46, 'longitude':25};
        latlong.RS = {'latitude':44, 'longitude':21};
        latlong.RU = {'latitude':60, 'longitude':100};
        latlong.RW = {'latitude':-2, 'longitude':30};
        latlong.SA = {'latitude':25, 'longitude':45};
        latlong.SB = {'latitude':-8, 'longitude':159};
        latlong.SC = {'latitude':-4.5833, 'longitude':55.6667};
        latlong.SD = {'latitude':15, 'longitude':30};
        latlong.SE = {'latitude':62, 'longitude':15};
        latlong.SG = {'latitude':1.3667, 'longitude':103.8};
        latlong.SH = {'latitude':-15.9333, 'longitude':-5.7};
        latlong.SI = {'latitude':46, 'longitude':15};
        latlong.SJ = {'latitude':78, 'longitude':20};
        latlong.SK = {'latitude':48.6667, 'longitude':19.5};
        latlong.SL = {'latitude':8.5, 'longitude':-11.5};
        latlong.SM = {'latitude':43.7667, 'longitude':12.4167};
        latlong.SN = {'latitude':14, 'longitude':-14};
        latlong.SO = {'latitude':10, 'longitude':49};
        latlong.SR = {'latitude':4, 'longitude':-56};
        latlong.ST = {'latitude':1, 'longitude':7};
        latlong.SV = {'latitude':13.8333, 'longitude':-88.9167};
        latlong.SY = {'latitude':35, 'longitude':38};
        latlong.SZ = {'latitude':-26.5, 'longitude':31.5};
        latlong.TC = {'latitude':21.75, 'longitude':-71.5833};
        latlong.TD = {'latitude':15, 'longitude':19};
        latlong.TF = {'latitude':-43, 'longitude':67};
        latlong.TG = {'latitude':8, 'longitude':1.1667};
        latlong.TH = {'latitude':15, 'longitude':100};
        latlong.TJ = {'latitude':39, 'longitude':71};
        latlong.TK = {'latitude':-9, 'longitude':-172};
        latlong.TM = {'latitude':40, 'longitude':60};
        latlong.TN = {'latitude':34, 'longitude':9};
        latlong.TO = {'latitude':-20, 'longitude':-175};
        latlong.TR = {'latitude':39, 'longitude':35};
        latlong.TT = {'latitude':11, 'longitude':-61};
        latlong.TV = {'latitude':-8, 'longitude':178};
        latlong.TW = {'latitude':23.5, 'longitude':121};
        latlong.TZ = {'latitude':-6, 'longitude':35};
        latlong.UA = {'latitude':49, 'longitude':32};
        latlong.UG = {'latitude':1, 'longitude':32};
        latlong.UM = {'latitude':19.2833, 'longitude':166.6};
        latlong.US = {'latitude':38, 'longitude':-97};
        latlong.UY = {'latitude':-33, 'longitude':-56};
        latlong.UZ = {'latitude':41, 'longitude':64};
        latlong.VA = {'latitude':41.9, 'longitude':12.45};
        latlong.VC = {'latitude':13.25, 'longitude':-61.2};
        latlong.VE = {'latitude':8, 'longitude':-66};
        latlong.VG = {'latitude':18.5, 'longitude':-64.5};
        latlong.VI = {'latitude':18.3333, 'longitude':-64.8333};
        latlong.VN = {'latitude':16, 'longitude':106};
        latlong.VU = {'latitude':-16, 'longitude':167};
        latlong.WF = {'latitude':-13.3, 'longitude':-176.2};
        latlong.WS = {'latitude':-13.5833, 'longitude':-172.3333};
        latlong.YE = {'latitude':15, 'longitude':48};
        latlong.YT = {'latitude':-12.8333, 'longitude':45.1667};
        latlong.ZA = {'latitude':-29, 'longitude':24};
        latlong.ZM = {'latitude':-15, 'longitude':30};
        latlong.ZW = {'latitude':-20, 'longitude':30};

        // Dummy data


        // Configure heatmap
        var max = -Infinity;
        var min = Infinity;
        mapData.forEach(function (itemOpt) {
            if (itemOpt.value > max) {
                max = itemOpt.value;
            }
            if (itemOpt.value < min) {
                min = itemOpt.value;
            }
        });

        // Colors
        var mapBackgroundColor = 'var(--map-bg)',
            mapPlaceholderColor = 'var(--map-placeholder-color)',
            mapHoverColor = 'var(--map-hover-color)',
            mapBorderColor = 'var(--map-border-color)',
            scatterColor = ['rgba(128,201,176,0.9)'];

        // Options
        map_world_scatter.setOption({
            height: 250,
            backgroundColor: mapBackgroundColor,

            // Global text style
            textStyle: {
                fontFamily: 'var(--body-font-family)',
                color: 'var(--body-color)',
                fontSize: 14,
                lineHeight: 22,
                textBorderColor: 'transparent'
            },

            // Tooltip
            tooltip: {
                trigger: 'item',
                formatter : function (params) {
                    return params.name+' numbers: ' + params.value[2];
                },
                className: 'shadow-sm rounded',
                backgroundColor: 'var(--white)',
                borderColor: 'rgba(var(--black-rgb), 0.5)',
                padding: [10, 15],
                textStyle: {
                    color: '#000'
                },
                axisPointer: {
                    type: 'shadow',
                    shadowStyle: {
                        color: 'rgba(var(--body-color-rgb), 0.025)'
                    }
                }
            },

            // Visual map
            visualMap: {
                show: false,
                min: 0,
                max: max,
                inRange: {
                    symbolSize: [6, 40],
                    color: scatterColor
                }
            },

            // Map config
            geo: {
                center: [0, 30],
                type: 'map',
                map: 'world',
                roam: true,
                zoom: 3,
                aspectScale: 0.85,
                scaleLimit: {
                    min: 2,
                    max: 14
                },
                label: {
                    emphasis: {
                        show: false
                    }
                },
                itemStyle: {
                    normal: {
                        areaColor: mapPlaceholderColor,
                        borderColor: mapBorderColor,
                        borderWidth: 1
                    },
                    emphasis: {
                        areaColor: mapHoverColor
                    }
                }
            },

            // Add series
            series: [
                {
                    type: 'scatter',
                    coordinateSystem: 'geo',
                    data: mapData.map(function (itemOpt) {
                        return {
                            name: itemOpt.name,
                            value: [
                                latlong[itemOpt.code].longitude,
                                latlong[itemOpt.code].latitude,
                                itemOpt.value
                            ],
                            label: {
                                emphasis: {
                                    show: false
                                }
                            },
                            itemStyle: {
                                normal: {
                                    color: itemOpt.color,
                                    opacity: 0.9
                                }
                            }
                        };
                    })
                }
            ]
        });

        map_world_scatter.on('click', function(params) {
            console.log(params);
            if(params.data){
                var name = params.data.name.replace(' ', '')
                $(".countries").removeClass('show');
                $(".countriesLink").addClass('collapsed');
                $("#country-"+name).addClass('show');
                $('a[href="#country-'+name+'"]').removeClass('collapsed');
            }
            else{
                var name = params.name.replace(' ', '')
                $(".countries").removeClass('show');
                $(".countriesLink").addClass('collapsed');
                $("#country-"+name).addClass('show');
                $('a[href="#country-'+name+'"]').removeClass('collapsed');
            }
        });
    }

    var triggerChartResize = function() {
        map_world_scatter_element && map_world_scatter.resize();
    };

    var sidebarToggle = document.querySelectorAll('.sidebar-control');
    if (sidebarToggle) {
        sidebarToggle.forEach(function(togglers) {
            togglers.addEventListener('click', triggerChartResize);
        });
    }

    // On window resize
    var resizeCharts;
    window.addEventListener('resize', function() {
        clearTimeout(resizeCharts);
        resizeCharts = setTimeout(function () {
            triggerChartResize();
        }, 200);
    });
}
function pieChartInit(){
    if (typeof echarts == 'undefined') {
        console.warn('Warning - echarts.min.js is not loaded.');
        return;
    }

    const pieRecommendationElement = document.getElementById('recommendationBreakdown');
    if(pieRecommendationElement) {
        var pieRecommendation = echarts.init(pieRecommendationElement, null, { renderer: 'svg' });
        pieRecommendation.setOption({
            color: [
                '#56A34C','#EE9328','#FF5A57'
            ],
            textStyle: {
                fontFamily: 'var(--body-font-family)',
                color: 'var(--body-color)',
                fontSize: 14,
                lineHeight: 22,
                textBorderColor: 'transparent'
            },
            title: {
                text: 'Recommendation breakdown',
                left: 'center',
                textStyle: {
                    fontSize: 20,
                    fontWeight: 500,
                    color: 'var(--body-color)'
                }
            },
            tooltip: {
                trigger: 'item',
                className: 'shadow-sm rounded',
                backgroundColor: 'var(--white)',
                borderColor: 'var(--gray-400)',
                padding: 15,
                textStyle: {
                    color: '#000'
                },
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                top: 'center',
                left: 0,
                data: ['Allow', 'Flag', 'Block'],
                itemHeight: 12,
                itemWidth: 12,
                textStyle: {
                    color: 'var(--body-color)'
                },
                itemStyle: {
                    borderColor: 'transparent'
                }
            },

            series: [{
                name: 'Recommendation',
                type: 'pie',
                radius: '60%',
                center: ['50%', '57.5%'],
                itemStyle: {
                    borderColor: 'var(--card-bg)'
                },
                label: {
                    color: 'var(--body-color)'
                },
                data: [
                    {value: allow, name: 'Allow'},
                    {value: flag, name: 'Flag'},
                    {value: block, name: 'Block'}
                ]
            }]
        });
    }

    const pieRiskLevelElement = document.getElementById('riskLevelBreakdown');
    if(pieRiskLevelElement) {
        var pieRiskLevel = echarts.init(pieRiskLevelElement, null, { renderer: 'svg' });
        pieRiskLevel.setOption({
            color: [
                '#56a34c','#88d680','#f6cb75','#ee9328',
                '#d87a80','#e15a57',
            ],
            textStyle: {
                fontFamily: 'var(--body-font-family)',
                color: 'var(--body-color)',
                fontSize: 14,
                lineHeight: 22,
                textBorderColor: 'transparent'
            },
            title: {
                text: 'Risk level breakdown',
                left: 'center',
                textStyle: {
                    fontSize: 20,
                    fontWeight: 500,
                    color: 'var(--body-color)'
                }
            },
            tooltip: {
                trigger: 'item',
                className: 'shadow-sm rounded',
                backgroundColor: 'var(--white)',
                borderColor: 'var(--gray-400)',
                padding: 15,
                textStyle: {
                    color: '#000'
                },
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                top: 'center',
                left: 0,
                data: ["Very low", "Low", "Medium low", "Medium", "High", "Very high"],
                itemHeight: 12,
                itemWidth: 12,
                textStyle: {
                    color: 'var(--body-color)'
                },
                itemStyle: {
                    borderColor: 'transparent'
                }
            },
            series: [{
                name: 'Risk level',
                type: 'pie',
                radius: '60%',
                center: ['50%', '57.5%'],
                itemStyle: {
                    borderColor: 'var(--card-bg)'
                },
                label: {
                    color: 'var(--body-color)'
                },
                data: [
                    {value: very_low, name: 'Very low'},
                    {value: low, name: 'Low'},
                    {value: medium_low, name: 'Medium low'},
                    {value: medium_low, name: 'Medium'},
                    {value: high, name: 'High'},
                    {value: very_high, name: 'Very high'}
                ]
            }]
        });
    }

    var triggerChartResize = function() {
        pieRecommendationElement && pieRecommendation.resize();
        pieRiskLevelElement && pieRiskLevel.resize();
    };
    var resizeCharts;
    window.addEventListener('resize', function() {
        clearTimeout(resizeCharts);
        resizeCharts = setTimeout(function () {
            triggerChartResize();
        }, 200);
    });
}
function initByCountry(country){
    if (typeof echarts == 'undefined') {
        console.warn('Warning - echarts.min.js is not loaded.');
        return;
    }

    var barsElement = document.getElementById('stackedBar'+country.country_iso);
    var pieRecommendationElement = document.getElementById('pieRecommendation'+country.country_iso);
    var pieRiskLevelElement = document.getElementById('pieRiskLevel'+country.country_iso);

    if (barsElement && pieRecommendationElement && pieRiskLevelElement) {
        var yAxisData = [];
        var allowData = [];
        var flagData = [];
        var blockData = [];

        country.types.forEach(type => {
            yAxisData.push(type.type);
            allowData.push(type.allow);
            flagData.push(type.flag);
            blockData.push(type.block);
        });

        var bars = echarts.init(barsElement, null, { renderer: 'svg' });
        var pieRecommendation = echarts.init(pieRecommendationElement, null, { renderer: 'svg' });
        var pieRiskLevel = echarts.init(pieRiskLevelElement, null, { renderer: 'svg' });

        bars.setOption({
            textStyle: {
                fontFamily: 'var(--body-font-family)',
                color: 'var(--body-color)',
                fontSize: 18,
                lineHeight: 22,
                textBorderColor: 'transparent'
            },
            animationDuration: 750,
            grid: {
                left: 0,
                right: 30,
                top: 35,
                bottom: 0,
                containLabel: true
            },
            legend: {
                data: ['Allow','Flag','Block'],
                itemHeight: 8,
                itemGap: 30,
                textStyle: {
                    color: 'var(--body-color)',
                    padding: [0, 5]
                }
            },
            tooltip: {
                trigger: 'axis',
                className: 'shadow-sm rounded',
                backgroundColor: 'var(--white)',
                borderColor: 'var(--gray-400)',
                padding: 15,
                textStyle: {
                    color: '#000'
                },
                axisPointer: {
                    type: 'shadow',
                    shadowStyle: {
                        color: 'rgba(var(--body-color-rgb), 0.025)'
                    }
                }
            },
            xAxis: [{
                type: 'value',
                axisLabel: {
                    color: 'rgba(var(--body-color-rgb), .65)'
                },
                axisLine: {
                    show: true,
                    lineStyle: {
                        color: 'var(--gray-500)'
                    }
                },
                splitLine: {
                    show: true,
                    lineStyle: {
                        color: 'var(--gray-300)',
                        type: 'dashed'
                    }
                }
            }],
            yAxis: [{
                type: 'category',
                data: yAxisData,
                axisLabel: {
                    color: 'rgba(var(--body-color-rgb), .65)'
                },
                axisLine: {
                    lineStyle: {
                        color: 'var(--gray-500)'
                    }
                },
                splitLine: {
                    show: true,
                    lineStyle: {
                        color: 'var(--gray-300)'
                    }
                },
                splitArea: {
                    show: true,
                    areaStyle: {
                        color: ['rgba(var(--white-rgb), .01)', 'rgba(var(--black-rgb), .01)']
                    }
                }
            }],
            series: [
                {
                    name: 'Allow',
                    type: 'bar',
                    stack: 'Total',
                    barWidth: 36,
                    itemStyle: {
                        color: '#56A34C'
                    },
                    label: {
                        show: true,
                        position: 'insideRight',
                        fontSize: 12,
                        fontWeight: 500,
                        formatter: function(params) {
                            return params.value > 0 ? params.value : '';
                        }
                    },
                    data: allowData
                },
                {
                    name: 'Flag',
                    type: 'bar',
                    stack: 'Total',
                    itemStyle: {
                        color: '#EE9328'
                    },
                    label: {
                        show: true,
                        position: 'insideRight',
                        fontSize: 12,
                        fontWeight: 500,
                        formatter: function(params) {
                            return params.value > 0 ? params.value : '';
                        }
                    },
                    data: flagData
                },
                {
                    name: 'Block',
                    type: 'bar',
                    stack: 'Total',
                    itemStyle: {
                        color: '#FF5A57'
                    },
                    label: {
                        show: true,
                        position: 'insideRight',
                        fontSize: 12,
                        fontWeight: 500,
                        formatter: function(params) {
                            return params.value > 0 ? params.value : '';
                        }
                    },
                    data: blockData
                }
            ]
        });
        pieRecommendation.setOption({
            color: [
                '#56A34C','#EE9328','#FF5A57'
            ],
            textStyle: {
                fontFamily: 'var(--body-font-family)',
                color: 'var(--body-color)',
                fontSize: 14,
                lineHeight: 22,
                textBorderColor: 'transparent'
            },
            title: {
                text: 'Recommendation breakdown',
                left: 'center',
                textStyle: {
                    fontSize: 20,
                    fontWeight: 500,
                    color: 'var(--body-color)'
                }
            },
            tooltip: {
                trigger: 'item',
                className: 'shadow-sm rounded',
                backgroundColor: 'var(--white)',
                borderColor: 'var(--gray-400)',
                padding: 15,
                textStyle: {
                    color: '#000'
                },
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                top: 'center',
                left: 0,
                data: ['Allow', 'Flag', 'Block'],
                itemHeight: 12,
                itemWidth: 12,
                textStyle: {
                    color: 'var(--body-color)'
                },
                itemStyle: {
                    borderColor: 'transparent'
                }
            },

            series: [{
                name: 'Recommendation',
                type: 'pie',
                radius: '60%',
                center: ['50%', '57.5%'],
                itemStyle: {
                    borderColor: 'var(--card-bg)'
                },
                label: {
                    color: 'var(--body-color)'
                },
                data: [
                    {value: country.allow, name: 'Allow'},
                    {value: country.flag, name: 'Flag'},
                    {value: country.block, name: 'Block'}
                ]
            }]
        });
        pieRiskLevel.setOption({
            color: [
                '#56a34c','#88d680','#f6cb75','#ee9328',
                '#d87a80','#e15a57',
            ],
            textStyle: {
                fontFamily: 'var(--body-font-family)',
                color: 'var(--body-color)',
                fontSize: 14,
                lineHeight: 22,
                textBorderColor: 'transparent'
            },
            title: {
                text: 'Risk level breakdown',
                left: 'center',
                textStyle: {
                    fontSize: 20,
                    fontWeight: 500,
                    color: 'var(--body-color)'
                }
            },
            tooltip: {
                trigger: 'item',
                className: 'shadow-sm rounded',
                backgroundColor: 'var(--white)',
                borderColor: 'var(--gray-400)',
                padding: 15,
                textStyle: {
                    color: '#000'
                },
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                top: 'center',
                left: 0,
                data: ["Very low", "Low", "Medium low", "Medium", "High", "Very high"],
                itemHeight: 12,
                itemWidth: 12,
                textStyle: {
                    color: 'var(--body-color)'
                },
                itemStyle: {
                    borderColor: 'transparent'
                }
            },
            series: [{
                name: 'Risk level',
                type: 'pie',
                radius: '60%',
                center: ['50%', '57.5%'],
                itemStyle: {
                    borderColor: 'var(--card-bg)'
                },
                label: {
                    color: 'var(--body-color)'
                },
                data: [
                    {value: country.very_low, name: 'Very low'},
                    {value: country.low, name: 'Low'},
                    {value: country.medium_low, name: 'Medium low'},
                    {value: country.medium_low, name: 'Medium'},
                    {value: country.high, name: 'High'},
                    {value: country.very_high, name: 'Very high'}
                ]
            }]
        });
    }

    var triggerChartResize = function() {
        barsElement && bars.resize();
        pieRecommendationElement && pieRecommendation.resize();
        pieRiskLevelElement && pieRiskLevel.resize();
    };

    var resizeCharts;
    window.addEventListener('resize', function() {
        clearTimeout(resizeCharts);
        resizeCharts = setTimeout(function () {
            triggerChartResize();
        }, 200);
    });
}
function activeCountryChartsInit(index){
    index = parseInt(index) - 1;
    var country = countriesData[index];


    initByCountry(country);
}
function showOneRecordScores(recordId){

    $.ajax({
        type:'GET',
        url:'/getOneRecord',
        data:{
            recordId: recordId,
        },
        success:function(data) {
            var codes = [
                ...JSON.parse(data[0].a2p),
                ...JSON.parse(data[0].category),
                ...JSON.parse(data[0].email_insight),
                ...JSON.parse(data[0].ip_insight),
                ...JSON.parse(data[0].number_type),
                // ...JSON.parse(data[0].p2p)
            ];
            codeMapping(codes);
            removeOldClasses(document.getElementById('riskLevelTitle'));
            removeOldClasses(document.getElementById('recommendationTitle'));

            $("#oneNumberNumber").text(data[0].number);
            $("#oneNumberRiskLevel").text(data[0].risk_level);
            $("#oneNumberRecommendation").text(data[0].recommendation);
            $("#oneNumberNumberScore").text(data[0].score);
            $("#oneNumberType").text(data[0].type);
            $("#oneNumberCountry").text(data[0].country_name);
            $("#oneNumberCarrier").text(data[0].carrier_name);
            $("#riskLevelTitle").addClass('bg-'+data[0].risk_level);
            $("#recommendationTitle").addClass('bg-'+data[0].risk_level);
            document.getElementById("oneScore").setAttribute("onclick","showHideScoreNav('one')");
        },
        error: function (error){
            notyAlert('Some unexpected error happened!', 'error');
            console.log(error);
        }
    });

    showHideScoreNav('one');
}
function codeMapping(codes){
    if(codes.length > 0){
        var dataSet = [];
        $.ajax({
            type:'GET',
            url:'/getCodes',
            data:{
                codes: codes,
            },
            success:function(data){
                console.log("inside",data);

                var mappingTable = $('.codeMappingDataT');
                if($.fn.DataTable.isDataTable( '.codeMappingDataT' )){
                    mappingTable.DataTable().destroy();
                }

                for (let i = 0; i < data.length; i++) {
                    dataSet.push(data[i]);
                }

                // console.log(dataSet);
                // return;

                // Initialize
                mappingTable.dataTable({
                    data: dataSet,
                    columnDefs: []
                });
            },
            error: function (error){
                notyAlert('Some unexpected error happened!','error');
                console.log(error);
            }
        });
    }
    else{
        $('#codeMapping').hide();
    }


    // if(data[0][0].scores.riskInsights.a2p != null){
    //     $('#codeMapping').show();
    //     var codes = [
    //         ...data[0][0].scores.riskInsights.a2p,
    //         ...data[0][0].scores.riskInsights.category,
    //         ...data[0][0].scores.riskInsights.email,
    //         ...data[0][0].scores.riskInsights.ip,
    //         ...data[0][0].scores.riskInsights.number_type,
    //         // ...data[0][0].scores.riskInsights.p2p,
    //     ];
    //
    //     var dataSet = [];
    //
    //     $.ajax({
    //         type:'GET',
    //         url:'/getCodes',
    //         data:{
    //             codes: codes,
    //         },
    //         success:function(data){
    //             console.log("inside",data);
    //             return;
    //             var mappingTable = $('.codeMappingDataT');
    //             if($.fn.DataTable.isDataTable( '.codeMappingDataT' )){
    //                 mappingTable.DataTable().destroy();
    //             }
    //
    //             for (let i = 0; i < data[0][0].length; i++) {
    //                 dataSet.push(data[0][0][i]);
    //             }
    //
    //             // Initialize
    //             mappingTable.dataTable({
    //                 data: dataSet,
    //                 columnDefs: []
    //             });
    //         },
    //         error: function (error){
    //             notyAlert('Some unexpected error happened!', "Error", 'error');
    //             console.log(error);
    //         }
    //     });
    // }
    // else{
    //     $('#codeMapping').hide();
    // }
}
function showHideScoreNav(nav){
    $(".scoreNavigation").removeClass('active');
    $("#"+nav+"Score").addClass('active');

    $(".scoreNavigationDisplay").addClass('d-none');
    $("#"+nav+"NumberScore").removeClass('d-none');
}
function showReadMore(text){
    notyAlert(text, 'info');
}
function showAllNumberScores(){
    showHideScoreNav('all')
}
function removeOldClasses(el) {
    var startsWith = "bg-";
    var classes = el.className.split(" ").filter(function(v) {
        return v.lastIndexOf(startsWith, 0) !== 0;
    });
    el.className = classes.join(" ").trim();
}
