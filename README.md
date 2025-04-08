# Add rel="canonical" entries for Glossary-, FAQ-, and News-, and Calendar  Items

Allows to add individual
```html
<link rel="canonical" href="...">
```
entries for pages that show  glossary-, FAQ-, calendar, or news items (i.e. pages where the respective reader module is included).

## Supported bundles

* Glossary `"oveleon/contao-glossary-bundle` with version constraint `"^2.0"`.
* FAQ `"contao/faq-bundle` 
* News `"contao/news-bundle`
* Calendar `"contao/calendar-bundle`.

## Note

Not selecting an option for “rel="canonical" setzen"” or selecting the option “Nicht setzen” does not mean there will 
be no `<link rel="canonical" ...>` in the page. It just means, this bundle will not perform any action (and Contao will 
probably set the header value).


## Roadmap

Make this bundle work with Contao 5.x. 

Required work: switch from the legacy content elements and frontend modules to controllers.

As of now 
 
* Glossary should be OK already
* FAQ `"contao/faq-bundle` still has `contao/modules/ModuleFaqReader` 
* News `"contao/news-bundle` still has `contao/modules/ModuleNewsReader`
* Calendar `"contao/calendar-bundle` still has `contao/modules/ModuleEventReader`

so the bundle should work with Contao 5.x already. (TODO test it!).


## References

* https://github.com/plenta/contao-rel-canonical-bundle Does more or less the same, but does not handle  
 glossaray items (see https://github.com/oveleon/contao-glossary-bundle)
  