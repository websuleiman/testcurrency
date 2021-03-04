<?php

namespace console\controllers;

use common\models\Currency;

class GetdataController extends \yii\console\Controller
{
    public function actionCurrency()
    {

        $currencies = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp');

        if(!empty($currencies)) {

            // достаем модель
                $data_currencies = Currency::find()->all();

                // если модель (таблица) пуста, тогда записываем данные в таблицу
                if(empty($data_currencies)) {
                    foreach ($currencies as $currency) {

                        $curr = new Currency();
                        $curr->name = $currency->Name;
                        $curr->rate = strval($currency->Value);
                        $curr->insert_dt = time();
                        $curr->save();

                    }
                    echo "Данные записаны в таблицк. все окей!\n";
                }


                // если модель не пуста, тогда обновляем данные
            foreach ($currencies as $currency) {

                $curr = Currency::find()
                    ->where(['name' => $currency->Name])
                    ->one();
                $curr->name = $currency->Name;
                $curr->rate = strval($currency->Value);
                $curr->insert_dt = time();
                $curr->save();

            }
            echo "Данные обновлены!\n";

        } else {
            echo 'Данные с сервера не получены! Повторите попытку позжею' . "\n" ;
        }


    }

}