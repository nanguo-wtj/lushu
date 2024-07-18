<div class="slideDownMap editLocationMap tosProjectCssMarker modalWrap" style="display: none;">
    <div class="mapContent shown">
        <div class="map__piecefulMap___cY63A mapBlock slideDownMapBLock">

            <div class="map__mapBlock___2rphQ mapboxgl-map">
                <div class="mapboxgl-canary" style="visibility: hidden;"></div>
                <div class="mapboxgl-canvas-container mapboxgl-interactive mapboxgl-touch-drag-pan mapboxgl-touch-zoom-rotate">

                    <iframe src="poi_map.html" class="poi-map-canvas" style="position: absolute; width: 1920px; height: 590px;" width="1920" height="590" frameborder="0"></iframe>
                </div>
                <div class="mapboxgl-control-container">
                    <div class="mapboxgl-ctrl-top-left"></div>
                    <div class="mapboxgl-ctrl-top-right"></div>
                    <div class="mapboxgl-ctrl-bottom-left">
                        <div class="mapboxgl-ctrl" style="display: block;">
                            <a class="mapboxgl-ctrl-logo" target="_blank" rel="noopener nofollow" href="https://www.mapbox.com/" aria-label="Mapbox logo"></a>
                        </div>
                    </div>
                    <div class="mapboxgl-ctrl-bottom-right"></div>
                </div>
            </div>
        </div>
        <div class="editLocations">
            <div class="searchPoiAddress">
                <div class="searchWrap searchWrapL">
                    <div class="searchBar">
                        <i class="btn-search  icon-search"></i>
                        <input type="text" class="search" placeholder="请输入POI名称" value="黄山" onchange="changePoi()">
                    </div>
                </div>
                <div class="poiShortcuts"></div>
            </div>
            <a href="javascript:void(0)" class="closeMapBtn" onclick="closeMap()">
                <i class="icon-close"></i>
            </a>
        </div>

    </div>
</div>
