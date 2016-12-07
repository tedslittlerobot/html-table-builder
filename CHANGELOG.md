# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

## 1.1.0
### Added
- `illuimate/support` to dev dependancies - useful for debugging.
- `nextRow` and `nextCell` methods to `Section` and `Row` respectively.
- Added `ImageCell`, `ContentCell` and `LinkCell` types
- Added header and body types for rows and sections

### Changed
- Change internal API - elements no longer hold references to their parents
- Change internal API - cells, rows and sections have an interface, an abstract class, and various types

### Removed
- **Breaking** - removed `$cell->cell()`, and `$row->nextCell()`

## 1.0.1 - 2016-11-28
### Added
- Added changelog!
- `wrapContent` method
- a few helper functions from `illuminate/support`.

### Removed
- `illuminate/support` dependancy.

## 1.0.0 - 2016-11-25
### Added
- Import whole project from other project - Table, Row, Cell, Section, TableRenderer classes, etc.
- Add packagist stuff

[Unreleased]: https://github.com/tedslittlerobot/html-table-builder/compare/v1.1.0...HEAD
[1.1.0]: https://github.com/tedslittlerobot/html-table-builder/compare/v1.0.1...v1.1.0
[1.0.1]: https://github.com/tedslittlerobot/html-table-builder/compare/v1.0.0...v1.0.1
[1.0.0]: https://github.com/tedslittlerobot/html-table-builder/compare/c9afd32...v1.0.0
