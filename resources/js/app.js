import './bootstrap';
import '../css/app.css';
import Vapor from 'laravel-vapor';

window.Vapor = Vapor;
window.Vapor.withBaseAssetUrl(import.meta.env.VITE_VAPOR_ASSET_URL)