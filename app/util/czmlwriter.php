<?php

//
//  Copyright (C) 2014 by Jackie Ng
//
//  This library is free software; you can redistribute it and/or
//  modify it under the terms of version 2.1 of the GNU Lesser
//  General Public License as published by the Free Software Foundation.
//
//  This library is distributed in the hope that it will be useful,
//  but WITHOUT ANY WARRANTY; without even the implied warranty of
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
//  Lesser General Public License for more details.
//
//  You should have received a copy of the GNU Lesser General Public
//  License along with this library; if not, write to the Free Software
//  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
//

class MgCzmlWriter
{
    private static function SingleFeatureToCzml($idVal, $reader, $geomCzml) {
        $output = "{";
        $output .= '"id": "'.$idVal.'"';

        $ttIndex = -1;
        $hlIndex = -1;
        try {
            $ttIndex = $reader->GetPropertyIndex(MgRestConstants::PROP_TOOLTIP);
        } catch (MgException $ex) { }
        try {
            $hlIndex = $reader->GetPropertyIndex(MgRestConstants::PROP_HYPERLINK);
        } catch (MgException $ex) { }

        $html = "";
        if ($ttIndex >= 0) {
            $html .= str_replace('\\\n', "<br/>", MgUtils::EscapeJsonString($reader->GetString($ttIndex)));
        }
        /*
        if ($hlIndex >= 0) {
            $html .= '<br/><a href=\"'.MgUtils::EscapeJsonString($reader->GetString($hlIndex)).'\">Click to open link</a>';
        }
        */
        //TODO: Include feature properties as specified in the Layer Definition

        if (strlen($html) > 0)
            $output .= ', "description": "'.$html.'"';

        $output .= ",";
        
        $output .= $geomCzml;

        $output .= "}";
        return $output;
    }

    public static function FeatureToCzml($reader, $agfRw, $transform, $geometryName, $style, $idName = NULL) {
        if (!$reader->IsNull($geometryName)) {

            $agf = null;
            $geom = null;

            try {
                $agf = $reader->GetGeometry($geometryName);
                $geom = $agfRw->Read($agf, $transform);
            }
            catch (MgException $ex) { //Bail on bad geometries
                return "";
            }

            $idIndex = -1;
            if ($idName != NULL)
                $idIndex = $reader->GetPropertyIndex($idName);

            //Write ID
            $idVal = "";
            if ($idIndex >= 0 && !$reader->IsNull($idIndex)) {
                $propType = $reader->GetPropertyType($idIndex);
                switch($propType) {
                    case MgPropertyType::DateTime:
                        $dt = $reader->GetDateTime($idIndex);
                        $idVal = '"'.$dt->ToString().'"';
                        break;
                    case MgPropertyType::Double:
                        $idVal = $reader->GetDouble($idIndex);
                        break;
                    case MgPropertyType::Int16:
                        $idVal = $reader->GetInt16($idIndex);
                        break;
                    case MgPropertyType::Int32:
                        $idVal = $reader->GetInt32($idIndex);
                        break;
                    case MgPropertyType::Int64:
                        $idVal = $reader->GetInt64($idIndex);
                        break;
                    case MgPropertyType::Single:
                        $idVal = $reader->GetSingle($idIndex);
                        break;
                    case MgPropertyType::String:
                        $idVal = MgUtils::EscapeJsonString($reader->GetString($idIndex));
                        break;
                }
            } else {
                $idVal = uniqid();
            }

            $elevIndex = -1;
            $extrude = 0.0;
            try {
                $elevIndex = $reader->GetPropertyIndex(MgRestConstants::PROP_Z_EXTRUSION);
                if ($elevIndex >= 0) {
                    switch ($reader->GetPropertyType($elevIndex)) {
                        case MgPropertyType::Int16:
                            $extrude = $reader->GetInt16($elevIndex);
                            break;
                        case MgPropertyType::Int32:
                            $extrude = $reader->GetInt32($elevIndex);
                            break;
                        case MgPropertyType::Int64:
                            $extrude = $reader->GetInt64($elevIndex);
                            break;
                        case MgPropertyType::Double:
                            $extrude = $reader->GetDouble($elevIndex);
                            break;
                        case MgPropertyType::Single:
                            $extrude = $reader->GetSingle($elevIndex);
                            break;
                    }
                }
                //TODO: If units not in meters, convert it to meters
            } catch (MgException $ex) { }

            switch ($geom->GetGeometryType()) {
                case MgGeometryType::Point:
                case MgGeometryType::LineString:
                case MgGeometryType::Polygon:
                    {
                        $geomCzml = self::GeometryToCzml($geom, $style, $extrude);
                        if ($geomCzml == null)
                            return "";

                        return self::SingleFeatureToCzml($idVal, $reader, $geomCzml);
                    }
                case MgGeometryType::MultiLineString:
                    {
                        //For multi-geometry features, we split this off into separate packets, one packet for
                        //each component geometry
                        $parts = array();
                        $featId = uniqid();
                        for ($i = 0; $i < $geom->GetCount(); $i++) {
                            $idValComp = $idVal."_segment_".$i."_".$featId;
                            $lineStr = $geom->GetLineString($i);
                            $geomCzml = self::GeometryToCzml($lineStr, $style, $extrude);
                            if ($geomCzml == null)
                                continue;

                            array_push($parts, self::SingleFeatureToCzml($idValComp, $reader, $geomCzml));
                        }
                        return implode(",", $parts);
                    }
                default:
                    return "";
            }
        } else {
            return "";
        }
    }

    private static function GeometryToCzml($geom, $style, $zval = 0.0) {
        $geomType = $geom->GetGeometryType();
        //TODO: Convert all the geometry types.
        //TODO: Translate Layer Definition styles to CZML styles
        switch ($geomType) {
            case MgGeometryType::Point:
                {
                    if (isset($style->point)) {
                        $coord = $geom->GetCoordinate();
                        $fragment  = '"point": { "color": { "rgba": ['.implode(",", $style->point->color).'] }, "pixelSize": { "number": '.$style->point->size.' } }, "position": { "cartographicDegrees": '.self::CoordToCzml($coord)." }";
                        return $fragment;
                    } else {
                        return null; //No style, draw nothing
                    }
                }
            case MgGeometryType::LineString:
                {
                    if (isset($style->line)) {
                        $coords = $geom->GetCoordinates();
                        $posCzml = self::LineStringToCzml($coords);
                        if ($posCzml != null)
                            return '"polyline": { "material": { "solidColor": { "color": { "rgba": ['.implode(",", $style->line->color).'] } } },"positions": '.$posCzml.'}';
                        else
                            return null;
                    } else {
                        return null; //No style, draw nothing
                    }
                }
            case MgGeometryType::Polygon:
                {
                    if (isset($style->area)) {
                        $fragment = '"polygon": { ';
                        if ($zval > 0.0) {
                            $fragment .= '"extrudedHeight": { "number": '.$zval.' }, ';
                        }
                        if (isset($style->area->outline) && $style->area->outline === true) {
                            $fragment .= '"outline": { "boolean": true }, "outlineColor": { "rgba": ['.implode(",", $style->area->outlineColor).'] }, ';
                        }
                        $fragment .= '"material": { "solidColor": { "color": { "rgba": ['.implode(",", $style->area->fillColor).'] } } },"positions": '.self::PolygonToCzml($geom).'}';
                        return $fragment;
                    } else {
                        return null; //No style, draw nothing
                    }
                }
            default:
                return null;
        }
    }

    private static function CoordToCzml($coord, $zval = 0.0, $enclose = true) {
        $str = "";
        if ($enclose)
            $str .= "[";
        $str .= $coord->GetX().",".$coord->GetY().",".$zval;
        if ($enclose)
            $str .= "]";
        return $str;
    }

    private static function LineStringToCzml($coords, $zval = 0.0) {
        //HACK: Cesium does not like polylines that are all the same coordinates.
        //To workaround this, we bail on any line strings that have identical coordinates
        //this assoc array will use to check for this
        $fragments = array();
        $str = '{ "cartographicDegrees": [';
        $first = true;
        while ($coords->MoveNext()) {
            if (!$first)
                $str .= ",";
            $coord = $coords->GetCurrent();
            $coordCzml = self::CoordToCzml($coord, $zval, false);
            if (!array_key_exists($coordCzml, $fragments))
                $fragments[$coordCzml] = true;
            $str .= $coordCzml;
            $first = false;
        }
        $str .= ']}';

        //If there's only one item, it means all czml fragments we try to put into this
        //array resolve to the same item. (ie. All coordinates are identical). In this case
        //return null to indicate that this packet should not be written
        if (count(array_keys($fragments)) == 1)
            return null;
        else
            return $str;
    }

    private static function PolygonToCzml($geom, $zval = 0.0) {
        $str = '{ "cartographicDegrees": [';
        $first = true;
        //TODO: Only handles exterior ring. Can CZML support polygons with holes?
        $extRing = $geom->GetExteriorRing();
        $coords = $extRing->GetCoordinates();
        while ($coords->MoveNext()) {
            if (!$first)
                $str .= ",";
            $coord = $coords->GetCurrent();
            $str .= self::CoordToCzml($coord, $zval, false);
            $first = false;
        }
        $str .= ']}';
        return $str;
    }
}

?>