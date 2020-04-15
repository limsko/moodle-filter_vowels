# Vowels Filter

## Description

One-letter conjunctions and prepositions (a, i, u, w, etc.) may remain at the end of the line in continuous text, while in book titles and their chapters they should be moved to the next line.

This principle is generally known. If a one-letter conjunction or preposition (i.e. so-called orphan, pendant, or hanging conjunction), type a, i, u, w, etc., appears at the end of a line. - It is better to move it to the next line. Leaving such words at the end of the line is not a mistake, but in practice it has been accepted to always move them, not only in the titles. It simply looks more aesthetic.

This filter changes all spaces between single character (like `a i o u w z`) to an `&nbsp;`
It is specially non-estetic on Polish sites.

So paragraph like this:

> The quick brown fox jumps over a
> lazy dog.

Will be displayed as:

> The quick brown fox jumps over
> a lazy dog.


## Release notes

### 1.2

- Code cleanup
- Added unicode letters support (że,się,ów)
- Optimized regex for better plugin filtering
- Released for newer versions of Moodle

### 1.1

- filtering inside html tags parameters bug fixed
- added new function to change space into hard-space before selected words

### 1.0

This is first release of this filter so please report any bugs You found.


## Requirements

There is no any special requirements for this filter.


## Installation

Install the plugin like any other plugin to folder `/filter/vowels`.

If You're installing with Plugin installer using zip archive choose plugin type: Text filter (filter).

See http://docs.moodle.org/en/Installing_plugins for details on installing Moodle plugins.


## Usage

First, activate the **filter_vowels** plugin in `Site Administration -> Plugins -> Filters -> Manage filters` then use filter settings to choose what letter/words should be glued to next word with non breaking character.


## Settings

**filter_vowels** has a settings page to allow you to change the filter to only certain letters.
You can also enable function that changes spaces after or/and before selected words into hard spaces.


## Copyright

Written by Kamil Łuczak.
kamil@limsko.pl
www.limsko.pl