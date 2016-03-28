Category Browse (plugin for Omeka)
==================================

[Category Browse] is a plugin for [Omeka] that enables browsing of Omeka Content
by element set, element name, and element text value.

It is available for Omeka 1.5 ([Category Browse (1.x)]) and for Omeka 2 ([Category Browse (2.x)]).


Installation
------------

Uncompress files and rename plugin folder "CategoryBrowse".

Then install it like any other Omeka plugin.


TODO
----

Immediate to dos:

1. Add pagination to results
2. Sort order by alpha in list view
3. Improve slug creation/deconstruction routine to handle library subject heading style punctuation
4. Add theme helper functions for use in item/show and item/browse pages

list view URL example: http://myomekainstall.org/categories/list/dublin-core/subject/
element text view URL example: http://myomekainstall.org/categories/browse/dublin-core/subject/Brooklyn+Public+Library

See inside CategoryBrowsePlugin.php too.


Warning
-------

Use it at your own risk.

It's always recommended to backup your files and database regularly so you can
roll back if needed.


Troubleshooting
---------------

See online issues on the [plugin issues] page on GitHub.


License
-------

This plugin is published under [GNU/GPL v3].

This program is free software; you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation; either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
details.

You should have received a copy of the GNU General Public License along with
this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.


Contact
-------

Current maintainers:

* Kevin Reiss (mail: <kevin.reiss@gmail.com>, see [kevinreiss] on GitHub)
* Daniel Berthereau (see [Daniel-KM] on GitHub, release [Category Browse (2.x)])


Copyright
---------

* Copyright Kevin Reiss, 2010
* Copyright Daniel Berthereau, 2016


[Omeka]: https://omeka.org
[Category Browse]: https://github.com/kevinreiss/Omeka-CategoryBrowse
[Category Browse (1.x)]: https://github.com/kevinreiss/Omeka-CategoryBrowse
[Category Browse (2.x)]: https://github.com/Daniel-KM/CategoryBrowse
[plugin issues (1.x)]: https://github.com/kevinreiss/Omeka-CategoryBrowse/issues
[plugin issues (2.x)]: https://github.com/Daniel-KM/CategoryBrowse/issues
[GNU/GPL v3]: https://www.gnu.org/licenses/gpl-3.0.html
[Jane Addams Papers Project]: http://janeaddamsproject.org
[kevinreiss]: https://github.com/kevinreiss
[Daniel-KM]: https://github.com/Daniel-KM "Daniel Berthereau"
