# $Id$
#
# Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
#								1785 E. Sahara Avenue, Suite 490-204
#								Las Vegas, Nevada 89104
#
# Licensed under The MIT License
# For full copyright and license information, please see the LICENSE.txt
# Redistributions of files must retain the above copyright notice.
# MIT License (http://www.opensource.org/licenses/mit-license.php)

CREATE TABLE aros_acos (
  id int(11) NOT NULL AUTO_INCREMENT,
  aro_id int(11) NOT NULL,
  aco_id int(11) NOT NULL,
  _create varchar(2) NOT NULL DEFAULT '0',
  _read varchar(2) NOT NULL DEFAULT '0',
  _update varchar(2) NOT NULL DEFAULT '0',
  _delete varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  UNIQUE KEY ARO_ACO_KEY (aro_id,aco_id)
)
