<?php

namespace FDevs\Sitemap\Util;

class Params
{
    /**
     * @param array $params
     *
     * @return array
     */
    public static function prepare($params = [])
    {
        $positions = array_combine(array_keys($params), array_fill(0, count($params), 0));
        $data = [];

        do {
            $data[] = self::getByIndexes($params, $positions);
        } while (self::updateIndexesToNextIteration($params, $positions));

        return $data;
    }

    /**
     * @param array $original
     * @param array $positions
     *
     * @return array
     */
    private static function getByIndexes(array $original, array $positions)
    {
        $result = [];

        foreach ($positions as $key => $position) {
            $result[$key] = $original[$key][$position];
        }

        return $result;
    }

    /**
     * @param array $original
     * @param array $positions
     *
     * @return bool
     */
    private static function updateIndexesToNextIteration(array $original, array &$positions)
    {
        // increment position
        $incremented = false;
        foreach ($positions as $key => $position) {
            ++$position;
            if ($position < count($original[$key])) {
                $positions[$key] = $position;
                $incremented = true;
                break;
            } else {
                $positions[$key] = 0;
            }
        }

        return $incremented;
    }
}
