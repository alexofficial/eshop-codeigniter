<?php
/**
 * This class  : have all methods for statistics.
 * @name Statistics_model.
 * @author Alex Patsanis <alexpatsanis@gmail.gr>
 * @filesource 
 * @api
 * @package application\models
 * @copyright Copyright (c) 2014-2015, Alexander Patsanis
 * 
 */
class Statistics_model extends CI_Model {

//============================================================================// 
    /**
     * This function gives as system date with mdate format..
     * @name date.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return date.
     */
    function date() {
        $datestring = "%Y-%m-%d";
        $time = time();
        $mdate = mdate($datestring, $time);
        return $mdate;
    }

//============================================================================// 
    /**
     * boolean function add statistics orders.
     * <p>Description:</p>
     * This function add statistics for orders.
     * @param $total
     * @name add_statistics_orders.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success return true return false.
     *
     */
    function add_statistics_orders($total) {

        $if_add_statistics_orders_per_day = $this->statistics_orders_per_day();
        if ($if_add_statistics_orders_per_day) {
            $if_add_statistics_orders_money_we_will_get = 
                    $this->statistics_orders_money_we_will_get($total);
            if ($if_add_statistics_orders_money_we_will_get) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * This function add statistics orders per day.
     * <p>Description:</p>
     * first checks if date we add exist 
     * if exist update with pluss statistics orders per day.
     * else insert a new date.
     * @name statistics orders per day.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return data. if query success return true else return false.
     */
    function statistics_orders_per_day() {
        $date = $this->date();

        $date_exist = $this->check_if_exist('statistics_orders_per_day', 
                'date', $date);
        if ($date_exist) {
            $this->db->where('date', $date);
            $this->db->set('numbers', 'numbers+1', FALSE);
            $query = $this->db->update('statistics_orders_per_day');

            if ($query) {
                return true;
            } else {
                return false;
            }
        } else {
            $data = array(
                'numbers' => 1,
                'date' => $date
            );
            $query = $this->db->insert('statistics_orders_per_day', $data);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }
    }
//============================================================================// 
    /**
     * This function add statistics orders money we will get.
     * <p>Description:</p>
     * first checks if date we add exist 
     * if exist update with pluss statistics orders money we will get per day.
     * else
     * insert a new date.
     * @param $total 
     * @name statistics orders money we will get.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if query success return true else return false.
     */
    function statistics_orders_money_we_will_get($total) {
        $date = $this->date();

     $date_exist = $this->check_if_exist('statistics_orders_money_we_will_get',
             'date', $date);
        if ($date_exist) {
            $this->db->where('date', $date);
            $this->db->set('money', 'money+"' . $total . '"', FALSE);
            $query = $this->db->update('statistics_orders_money_we_will_get');

            if ($query) {
                return true;
            } else {
                return false;
            }
        } else {
            $data = array(
                'money' => $total,
                'date' => $date
            );
       $query = $this->db->insert('statistics_orders_money_we_will_get', $data);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }
    }
//============================================================================// 
    /**
     * This function add statistics generics pluss.
     * <p>Description:</p>
     * first checks if date we add exist 
     * if exist update with pluss statistics.
     * else
     * insert a new date.
     * @param $table 
     * @name add statistics generics pluss.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if query success return true else return false.
     */
    function add_statistics_generics_pluss($table) {
        $date = $this->date();

        $date_exist = $this->check_if_exist($table, 'date', $date);
        if ($date_exist) {
            $this->db->where('date', $date);
            $this->db->set('numbers', 'numbers+1', FALSE);
            $query = $this->db->update($table);

            if ($query) {
                return true;
            } else {
                return false;
            }
        } else {
            $data = array(
                'numbers' => 1,
                'date' => $date
            );
            $query = $this->db->insert($table, $data);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }
    }
//============================================================================// 
    /**
     * This function add statistics admin orders pluss.
     * <p>Description:</p>
     * first checks if date we add exist 
     * if exist update with pluss statistics admin orders.
     * else
     * insert a new date.
     * @param $table 
     * @name add_statistics_admin_orders_pluss.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if query success return true else return false.
     */
    function add_statistics_admin_orders_pluss($table) {
        $date = $this->date();

        $date_exist = $this->check_if_exist($table, 'date', $date);
        if ($date_exist) {
            $this->db->where('date', $date);
            $this->db->set('numbers', 'numbers+1', FALSE);
            $query = $this->db->update($table);

            if ($query) {
                return true;
            } else {
                return false;
            }
        } else {
            $data = array(
                'numbers' => 1,
                'date' => $date
            );
            $query = $this->db->insert($table, $data);
            if ($query) {
                return true;
            } else {
                return false;
            }
        }
    }
//============================================================================// 
    /**
     * This function if statistics admin orders abstraction.
     * <p>Description:</p>
     * first checks if date we add exist 
     * if exist update with abstraction statistics admin orders.
     * @param $table 
     * @name add statistics admin orders abstraction.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if query success return true else return false.
     */
    function add_statistics_admin_orders_abstraction($table) {
        $date = $this->date();

        $date_exist = $this->check_if_exist($table, 'date', $date);
        if ($date_exist) {
            $this->db->where('date', $date);
            $this->db->set('numbers', 'numbers-1', FALSE);
            $query = $this->db->update($table);

            if ($query) {
                return true;
            } else {
                return false;
            }
        } else {
            echo "this date dont exist";
            return false;
        }
    }
//============================================================================// 
    /**
     * Boolean function check if something sexist.
     * <p>Description:</p>
     * This function select all $table and check if $where_data exist.
     * @param string $table
     * @param string $where_var
     * @param string $where_data
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if find this $where_data return true else return false.
     */
    function check_if_exist($table, $where_var, $where_data) {
        $query = $this->db->query("SELECT * FROM $table WHERE $where_var='" 
                . $where_data . "'");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================//
}
