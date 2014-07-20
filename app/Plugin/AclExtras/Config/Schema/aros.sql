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

CREATE TABLE aros (
  id int(10) NOT NULL AUTO_INCREMENT,
  parent_id int(10) DEFAULT NULL,
  model varchar(255) DEFAULT NULL,
  foreign_key int(10) DEFAULT NULL,
  alias varchar(255) DEFAULT NULL,
  lft int(10) DEFAULT NULL,
  rght int(10) DEFAULT NULL,
  PRIMARY KEY (id)
)