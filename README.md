# SilverStripe Chapters
Use and present our Pages as Chapters with content table and prev-next context

## User Story:

As CMS Content Author
I want to create a page for users which will act as a "Book"

- Book consists of different page types like:
  - Front Page (which is part of Book Page type itself)
  - Chapters Page
  - Sub-Chapters Page
  - Table of Contents Page
    - based on book part with possibility to add Content as Block?
    - one per Book?
  - Simple Page
- Book has simple Front-Page based on standard Page Type
- Front-Page has possibility (checkbox in CMS) to show Minimalistic Table of Content of the Book 
- each Book Part is simle page with heading: is is used as name of given part of the Book 
- Name of Book Part is used as part of Table of Contents
  - Content Author can exclude some Book Parts from Table of Contents
- Sub-Chapters (sub type of Book Part) is excluded from Minimalistic Table of Content
- Chapters are automatically numbered (based on position in page tree) 
  - simple numbering 1, 2, 3, 4, 5
- Sub-Chapters are automatically numbered based on position to their parent Chapter
  - eg: Chapter is 2 ; child Sub-Chapters are numbered 2.1, 2.2, 2.3
  - nice to have: Sub-Chapter under another Sub-Chapter might be numbered like 2.1.1, 2.1.2, 2.1.3  
- each Book Part have possibility to place a link to "Table of Contents"
- each Book Part have possiblity to place a link to Previous or Next part of the Book
  - first and last Book Parts are exception obviously

### Example:

#### Minimalistic Table of Contents

**Content** *(page type: Book Part or Table of Contents)*  
**Acknowledgments** *(Book Part)*  
**Part 1: Some Name** *(Book Part)*  
**1. Lorem Chapter** *(Chapter)*  
**2. Ipsum Chapter** *(Chapter)*  
**3. Dolor Amet Chapter** *(Chapter)*  
**Part 2: Another Lipsum** *(Book Part)*  
**4. Summary Name Chapter** *(Chapter)*  
**Final Note** *(Book Part)*  

#### Table of Contents

**Content** *(page type: Book Part or Table of Contents)*  
**Acknowledgments** *(Book Part)*  
**Part 1: Some Name** *(Book Part)*  
**1. Lorem Chapter** *(Chapter)*  
1.1 Primary Important Name *(Sub-Chapter)*  
1.2 Absolutely Name For People *(Sub-Chapter)*  
**2. Ipsum Chapter** *(Chapter)*  
2.1 Vestibulum sit amet *(Sub-Chapter)*  
**3. Dolor Amet Chapter** *(Chapter)*  
3.1 Nunc at urna *(Sub-Chapter)*  
3.2 Morbi pharetra  *(Sub-Chapter)*  
3.3 Sed sit amet dapibus *(Sub-Chapter)*  
**Part 2: Another Lipsum** *(Book Part)*  
**4. Summary Name Chapter** *(Chapter)*  
4.1 Aliquam convallis *(Sub-Chapter)*  
**Final Note** *(Book Part)*  

- link `next` from `2.1` refers to Chapter `3`
- link `prev` from `4` refers to Book Part `Part 2`

### References:

 - idea: https://mentalhealth.inquiry.govt.nz/inquiry-report/he-ara-oranga/
   - created completely manually
