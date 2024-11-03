<x-app-layout>
    @include('layouts.title_content', [
        'breadcrumb' => 'EXV  / Dashboard',
        'title' => 'Dashboard'
    ])
    <div class="chart-container">
        <div class="chart-1">
            <div class="down-load-chart-1">
                <button onclick="downloadChart('myChart1')" class="click-download-chart-1">
                    <svg width="22" height="22" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_182615_2778)">
                            <rect width="22" height="22" fill="white" fill-opacity="0.01"/>
                            <path d="M7.88736 10.6575C7.90073 10.6745 7.9178 10.6883 7.93729 10.6978C7.95678 10.7073 7.97818 10.7123 7.99986 10.7123C8.02155 10.7123 8.04294 10.7073 8.06244 10.6978C8.08193 10.6883 8.099 10.6745 8.11236 10.6575L10.1124 8.1271C10.1856 8.03424 10.1195 7.89674 9.99986 7.89674H8.67665V1.85389C8.67665 1.77531 8.61237 1.71103 8.53379 1.71103H7.46236C7.38379 1.71103 7.31951 1.77531 7.31951 1.85389V7.89496H5.99986C5.88022 7.89496 5.81415 8.03246 5.88736 8.12532L7.88736 10.6575ZM14.5356 10.0325H13.4642C13.3856 10.0325 13.3213 10.0967 13.3213 10.1753V12.9253H2.67844V10.1753C2.67844 10.0967 2.61415 10.0325 2.53558 10.0325H1.46415C1.38558 10.0325 1.32129 10.0967 1.32129 10.1753V13.711C1.32129 14.0271 1.57665 14.2825 1.89272 14.2825H14.107C14.4231 14.2825 14.6784 14.0271 14.6784 13.711V10.1753C14.6784 10.0967 14.6142 10.0325 14.5356 10.0325Z" fill="#1890FF"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_182615_2778">
                                <rect width="22" height="22" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </button>
            </div>
            <div class="revenue">
                <span>Revenue</span>
            </div>
            <canvas id="myChart1" class="myChart1"></canvas>
            <div id="totalValue"></div>
        </div>
        <div class="chart-2">
            <div class="down-load-chart-2">
                <button onclick="downloadChart('myChart2')" class="click-download-chart-2">
                    <svg width="22" height="22" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_182615_2778)">
                            <rect width="22" height="22" fill="white" fill-opacity="0.01"/>
                            <path d="M7.88736 10.6575C7.90073 10.6745 7.9178 10.6883 7.93729 10.6978C7.95678 10.7073 7.97818 10.7123 7.99986 10.7123C8.02155 10.7123 8.04294 10.7073 8.06244 10.6978C8.08193 10.6883 8.099 10.6745 8.11236 10.6575L10.1124 8.1271C10.1856 8.03424 10.1195 7.89674 9.99986 7.89674H8.67665V1.85389C8.67665 1.77531 8.61237 1.71103 8.53379 1.71103H7.46236C7.38379 1.71103 7.31951 1.77531 7.31951 1.85389V7.89496H5.99986C5.88022 7.89496 5.81415 8.03246 5.88736 8.12532L7.88736 10.6575ZM14.5356 10.0325H13.4642C13.3856 10.0325 13.3213 10.0967 13.3213 10.1753V12.9253H2.67844V10.1753C2.67844 10.0967 2.61415 10.0325 2.53558 10.0325H1.46415C1.38558 10.0325 1.32129 10.0967 1.32129 10.1753V13.711C1.32129 14.0271 1.57665 14.2825 1.89272 14.2825H14.107C14.4231 14.2825 14.6784 14.0271 14.6784 13.711V10.1753C14.6784 10.0967 14.6142 10.0325 14.5356 10.0325Z" fill="#1890FF"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_182615_2778">
                                <rect width="22" height="22" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </button>
            </div>
            <div class="revenue">
                <span>Number of Members</span>
            </div>
            <canvas id="myChart2"></canvas>
            <div id="legend2" style="margin-top: 10px; display: flex; flex-wrap: wrap; justify-content: center; max-height: 150px; overflow-y: auto;"></div>
        </div>
    </div>
</x-app-layout>
