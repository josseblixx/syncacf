<?php

    namespace BlixxSyncACF;

    class SyncACF
    {

        static private $_instance;

        /**
         *
         */
        static public function sync()
        {

            self::instance()->hook();
            

        }


        /**
         * @return SyncACF
         */
        static public function instance()
        {

            return self::$_instance ?: new self();

        }


        private function hook()
        {

            add_filter('acf/settings/save_json', function () {

                // update path
                $path = get_stylesheet_directory() . '/advanced-custom-fields';

                if (!file_exists($path)){
                    if (!(mkdir($path) && is_dir($path))){
                        throw new \Exception('Cannot create sync folder for ACF');
                    }
                }

                // return
                return $path;

            });

            add_filter('acf/settings/load_json', function( ) {

                // append path
                return [get_stylesheet_directory() . '/advanced-custom-fields'];

            });

        }


    }

