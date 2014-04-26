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

CREATE TABLE cake_sessions (
  id varchar(255) NOT NULL default '',
  data text,
  ip varchar(100),
  useragent varchar(255),
  os varchar(255),
  browser varchar(255),
  browserversion varchar(255),
  city varchar(255),
  country varchar(255),
  state varchar(255),
  expires int(11) default NULL,
  PRIMARY KEY  (id)
);