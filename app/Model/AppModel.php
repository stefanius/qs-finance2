<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model
{
	/**
	 * fullTableName
	 *
	 * Provides access to the Model's DataSource's ::fullTableName() method.
	 * Returns the fully quoted and prefixed table name for the current Model.
	 *
	 * @access public
	 * @param boolean $quote Whether you want the table name quoted.
	 * @param boolean $schema Whether you want the schema name included.
	 * @return string  Full quoted table name.
	 */
	public function fullTableName($quote = true, $schema = true) {
		$datasource = $this->GetDataSource();
		return $datasource->fullTableName($this, $quote, $schema);
	}
	
	/**
	 * truncate
	 *
	 * Truncates ALL RECORDS from the Model it is called from! VERY DANGEROUS!
	 * Depends on the ::fullTableName() method to concatenate the configured
	 * table prefix and table name together and quote the whole bit properly.
	 *
	 * @access  public
	 * @return  mixed
	 */
	public function truncate() {
		$fullName = $this->fullTableName();
		$q = 'TRUNCATE TABLE %s';
		return $this->query(sprintf($q, $fullName));
	}
}
