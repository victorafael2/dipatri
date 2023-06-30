import geopandas as gpd
import pandas as pd

# Carregar o shapefile usando o geopandas
shapefile_path = "../../../PIAUI_TERRITORIOS.shp"
gdf = gpd.read_file(shapefile_path)

# Converter o GeoDataFrame para um DataFrame do pandas
df = pd.DataFrame(gdf)

# Definir o caminho para o arquivo Excel
excel_file_path = "../../../PIAUI_TERRITORIOS.xlsx"

# Salvar o DataFrame no arquivo Excel
df.to_excel(excel_file_path, index=False)
