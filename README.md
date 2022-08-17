# Bibcite Organization Extras

This module attempts to add features that help to demonstrate the contributor output
for contributors within an organization.

A lot was done in bibcite to avoid duplication that would result in the one-to-many 
relationship from a reference to all of the reference contributors.   In order to isolate
contributors within an organization, that relationship needs to be re-normalized.

There are views fields and views filters to help reintroduce the bibcite_reference__author
table to queries in order to filter by contributor category, which was chosen as the field
least likely to impact normal citation formatting.

The rest of the current functionality comes from config entities onboard the config dir.

## TODO

- Tests to make sure configs load and work
- Allow for userref, taxref, and noderef org associations
- Actions to help with contributor management.

