var wms_layers = [];


        var lyr_GoogleSatellite_0 = new ol.layer.Tile({
            'title': 'Google Satellite',
            'type': 'base',
            'opacity': 1.000000,
            
            
            source: new ol.source.XYZ({
    attributions: ' &middot; <a href="https://www.google.at/permissions/geoguidelines/attr-guide.html">Map data ©2015 Google</a>',
                url: 'https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}'
            })
        });
var format_Municipios_1 = new ol.format.GeoJSON();
var features_Municipios_1 = format_Municipios_1.readFeatures(json_Municipios_1, 
            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
var jsonSource_Municipios_1 = new ol.source.Vector({
    attributions: ' ',
});
jsonSource_Municipios_1.addFeatures(features_Municipios_1);
var lyr_Municipios_1 = new ol.layer.Vector({
                declutter: true,
                source:jsonSource_Municipios_1, 
                style: style_Municipios_1,
                interactive: true,
                title: '<img src="styles/legend/Municipios_1.png" /> Municipios'
            });
var format_RegularizaoFundiaria_2 = new ol.format.GeoJSON();
var features_RegularizaoFundiaria_2 = format_RegularizaoFundiaria_2.readFeatures(json_RegularizaoFundiaria_2, 
            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
var jsonSource_RegularizaoFundiaria_2 = new ol.source.Vector({
    attributions: ' ',
});
jsonSource_RegularizaoFundiaria_2.addFeatures(features_RegularizaoFundiaria_2);
var lyr_RegularizaoFundiaria_2 = new ol.layer.Vector({
                declutter: true,
                source:jsonSource_RegularizaoFundiaria_2, 
                style: style_RegularizaoFundiaria_2,
                interactive: true,
                title: '<img src="styles/legend/RegularizaoFundiaria_2.png" /> Regularização Fundiaria'
            });
var format_DPCT_3 = new ol.format.GeoJSON();
var features_DPCT_3 = format_DPCT_3.readFeatures(json_DPCT_3, 
            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
var jsonSource_DPCT_3 = new ol.source.Vector({
    attributions: ' ',
});
jsonSource_DPCT_3.addFeatures(features_DPCT_3);
var lyr_DPCT_3 = new ol.layer.Vector({
                declutter: true,
                source:jsonSource_DPCT_3, 
                style: style_DPCT_3,
                interactive: true,
                title: '<img src="styles/legend/DPCT_3.png" /> DPCT'
            });
var format_reasEstaduais_4 = new ol.format.GeoJSON();
var features_reasEstaduais_4 = format_reasEstaduais_4.readFeatures(json_reasEstaduais_4, 
            {dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857'});
var jsonSource_reasEstaduais_4 = new ol.source.Vector({
    attributions: ' ',
});
jsonSource_reasEstaduais_4.addFeatures(features_reasEstaduais_4);
var lyr_reasEstaduais_4 = new ol.layer.Vector({
                declutter: true,
                source:jsonSource_reasEstaduais_4, 
                style: style_reasEstaduais_4,
                interactive: true,
                title: '<img src="styles/legend/reasEstaduais_4.png" /> Áreas Estaduais'
            });

lyr_GoogleSatellite_0.setVisible(true);lyr_Municipios_1.setVisible(true);lyr_RegularizaoFundiaria_2.setVisible(true);lyr_DPCT_3.setVisible(true);lyr_reasEstaduais_4.setVisible(true);
var layersList = [lyr_GoogleSatellite_0,lyr_Municipios_1,lyr_RegularizaoFundiaria_2,lyr_DPCT_3,lyr_reasEstaduais_4];
lyr_Municipios_1.set('fieldAliases', {'CD_MUN': 'CD_MUN', 'NM_MUN': 'NM_MUN', 'SIGLA_UF': 'SIGLA_UF', 'AREA_KM2': 'AREA_KM2', });
lyr_RegularizaoFundiaria_2.set('fieldAliases', {'fid': 'fid', 'SEI': 'SEI', 'INTERESSAD': 'INTERESSAD', 'PROPRIEDAD': 'PROPRIEDAD', 'MUNICIPIO': 'MUNICIPIO', 'AREA_HA': 'AREA_HA', 'P_ANT_APEN': 'P_ANT_APEN', 'REQ_ANTERI': 'REQ_ANTERI', 'ASSUNTO': 'ASSUNTO', 'TITULADA': 'TITULADA', 'ANO_TITULA': 'ANO_TITULA', 'SIT_JURIDI': 'SIT_JURIDI', 'VISTORIADO': 'VISTORIADO', 'DT_REL_VIS': 'DT_REL_VIS', 'GEOANALISE': 'GEOANALISE', 'MATRICULA': 'MATRICULA', 'CERT_INCRA': 'CERT_INCRA', 'SIGEF': 'SIGEF', 'SNCI': 'SNCI', 'TIPO': 'TIPO', 'OBS': 'OBS', 'LOC_AREA': 'LOC_AREA', 'perímetro': 'perímetro', 'área_ha': 'área_ha', 'perímet_1': 'perímet_1', 'ngw_id': 'ngw_id', });
lyr_DPCT_3.set('fieldAliases', {'fid': 'fid', 'SEI': 'SEI', 'nome_area': 'nome_area', 'font_dados': 'font_dados', 'nm_proc': 'nm_proc', 'parcela_co': 'parcela_co', 'registro_m': 'registro_m', 'detentor_n': 'detentor_n', 'obs': 'obs', 'area_hecta': 'area_hecta', 'natureza': 'natureza', 'situacao_i': 'situacao_i', 'status': 'status', 'municipio_': 'municipio_', 'nm_municip': 'nm_municip', 'ob_descric': 'ob_descric', 'ngw_id': 'ngw_id', });
lyr_reasEstaduais_4.set('fieldAliases', {'fid': 'fid', 'sei': 'sei', 'parcela_co': 'parcela_co', 'detentor_n': 'detentor_n', 'nome_area': 'nome_area', 'codigo_imo': 'codigo_imo', 'registro_m': 'registro_m', 'area_hecta': 'area_hecta', 'natureza': 'natureza', 'situacao_i': 'situacao_i', 'status': 'status', 'municipio_': 'municipio_', 'obs': 'obs', 'destinacao': 'destinacao', 'registro_c': 'registro_c', 'nm_municip': 'nm_municip', 'cod_sipra': 'cod_sipra', 'ngw_id': 'ngw_id', });
lyr_Municipios_1.set('fieldImages', {'CD_MUN': '', 'NM_MUN': '', 'SIGLA_UF': '', 'AREA_KM2': '', });
lyr_RegularizaoFundiaria_2.set('fieldImages', {'fid': '', 'SEI': '', 'INTERESSAD': '', 'PROPRIEDAD': '', 'MUNICIPIO': '', 'AREA_HA': '', 'P_ANT_APEN': '', 'REQ_ANTERI': '', 'ASSUNTO': '', 'TITULADA': '', 'ANO_TITULA': '', 'SIT_JURIDI': '', 'VISTORIADO': '', 'DT_REL_VIS': '', 'GEOANALISE': '', 'MATRICULA': '', 'CERT_INCRA': '', 'SIGEF': '', 'SNCI': '', 'TIPO': '', 'OBS': '', 'LOC_AREA': '', 'perímetro': '', 'área_ha': '', 'perímet_1': '', 'ngw_id': '', });
lyr_DPCT_3.set('fieldImages', {'fid': '', 'SEI': '', 'nome_area': '', 'font_dados': '', 'nm_proc': '', 'parcela_co': '', 'registro_m': '', 'detentor_n': '', 'obs': '', 'area_hecta': '', 'natureza': '', 'situacao_i': '', 'status': '', 'municipio_': '', 'nm_municip': '', 'ob_descric': '', 'ngw_id': '', });
lyr_reasEstaduais_4.set('fieldImages', {'fid': '', 'sei': '', 'parcela_co': '', 'detentor_n': '', 'nome_area': '', 'codigo_imo': '', 'registro_m': '', 'area_hecta': '', 'natureza': '', 'situacao_i': '', 'status': '', 'municipio_': '', 'obs': '', 'destinacao': '', 'registro_c': '', 'nm_municip': '', 'cod_sipra': '', 'ngw_id': '', });
lyr_Municipios_1.set('fieldLabels', {'CD_MUN': 'no label', 'NM_MUN': 'no label', 'SIGLA_UF': 'no label', 'AREA_KM2': 'no label', });
lyr_RegularizaoFundiaria_2.set('fieldLabels', {'fid': 'no label', 'SEI': 'no label', 'INTERESSAD': 'no label', 'PROPRIEDAD': 'no label', 'MUNICIPIO': 'no label', 'AREA_HA': 'no label', 'P_ANT_APEN': 'no label', 'REQ_ANTERI': 'no label', 'ASSUNTO': 'no label', 'TITULADA': 'no label', 'ANO_TITULA': 'no label', 'SIT_JURIDI': 'no label', 'VISTORIADO': 'no label', 'DT_REL_VIS': 'no label', 'GEOANALISE': 'no label', 'MATRICULA': 'no label', 'CERT_INCRA': 'no label', 'SIGEF': 'no label', 'SNCI': 'no label', 'TIPO': 'no label', 'OBS': 'no label', 'LOC_AREA': 'no label', 'perímetro': 'no label', 'área_ha': 'no label', 'perímet_1': 'no label', 'ngw_id': 'no label', });
lyr_DPCT_3.set('fieldLabels', {'fid': 'no label', 'SEI': 'no label', 'nome_area': 'no label', 'font_dados': 'no label', 'nm_proc': 'no label', 'parcela_co': 'no label', 'registro_m': 'no label', 'detentor_n': 'no label', 'obs': 'no label', 'area_hecta': 'no label', 'natureza': 'no label', 'situacao_i': 'no label', 'status': 'no label', 'municipio_': 'no label', 'nm_municip': 'no label', 'ob_descric': 'no label', 'ngw_id': 'no label', });
lyr_reasEstaduais_4.set('fieldLabels', {'fid': 'no label', 'sei': 'no label', 'parcela_co': 'no label', 'detentor_n': 'no label', 'nome_area': 'no label', 'codigo_imo': 'no label', 'registro_m': 'no label', 'area_hecta': 'no label', 'natureza': 'no label', 'situacao_i': 'no label', 'status': 'no label', 'municipio_': 'no label', 'obs': 'no label', 'destinacao': 'no label', 'registro_c': 'no label', 'nm_municip': 'no label', 'cod_sipra': 'no label', 'ngw_id': 'no label', });
lyr_reasEstaduais_4.on('precompose', function(evt) {
    evt.context.globalCompositeOperation = 'normal';
});