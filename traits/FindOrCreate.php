<?php

trait FindOrCreate
{
    /**
     * @param $key
     * @return \FindOrCreate
     */
    public static function findOrCreate($key): self
    {
        if (is_array($key)) {
            $condition = $key;
        } else {
            $fieldName = static::getTableSchema()->primaryKey;
            if (count($fieldName) > 1) {
                throw new \RuntimeException('Composite keys doesn\'t support');
            }
            $fieldName = reset($fieldName);
            $condition = [$fieldName => $key];
        }

        /** @noinspection PhpUndefinedMethodInspection */
        $model = static::find()->where($condition)->one();

        /** @noinspection PhpMethodParametersCountMismatchInspection */
        return $model ?? new static($condition);
    }
}
