ADMIN PAGE:

- **Create User** – TBD (They might use OAuth)
- **Lookup Department**
  - URL Params
    - Dept-code
  - Alternative: Just a data table that shows all departments with modify next to it.
- **Create Departments**
  - **Add interactive user sequence draggable box thingy**
- **Create a workflow**
  - **A table with all workflows per dept**
  - **Ability to**
- **Error Log**
  - **Deprecate if not needed**

STUDENT PAGE:

- My Account
  - Section 1: Account details in a section with edit button
  - Section 2: Colorblind options
  - Section 3: Email Notification
  - My signature
- My Applications
  - Add an application date and sort by that
- Export Application
  - When application is complete, students can download a pdf version of the entire form completed.
  - **This can be moved to higher accounts**

**TBD**

**DATABASE:**

1. **Add application util logs.**
2. **Application\_util add progress(Boolean)**
3. **Add Column**
  1. **S20\_faculty\_info : profile type, signature**
    1. **Should allow: deans, instructor, chair types**
4. **CREATE TABLES**
  1. **S20\_dean\_info**

- **Enable Dark Mode**

**ADMIN PAGE:**

1. **Add functions; Create/Modify Workflow**
2. **Finish**
  - **Search User**
    - **Needs a student page**
      - **Has to include:**
        - **Student info**
        - **Student progress**
        - **Student applications**
        - **Where they are working/employer deets stuff**
  - **Create User**
    - **Create user**
      - **Checks to see if user exists on submit**
        - **If not make user**
          - **Send user custom email to signup**
  - **View Courses**
    - **Show instructor email on table**
    - **View courses on click on table**
      - **Modify who is teaching the course**
      - **Edit Course number and attribute**
        - **Checks to see if there is conflict**
          - **IF NOT proceed**
  - **View Workflow:**
    - **View Application**
      - **Can see:**
        - **All of s20\_applicationinfo, s20\_company\_info, logs of rejection notices, s20\_employer\_info, s20\_learning\_objectives, s20\_project\_info, s20\_faculty info**
    - **Complete create application (not sure what to do here)**

**Student Page:**

1. **My Account**
  1. **Complete transactions and validation**
  2. **Complete change password**
2. **View Application:**
  1. **Review.php**
    1. **Get data from database to fill form**
    2. **Fix submit revised app**
      1. **On submit change application from reject to not rejected**
      2. **Log this revision in the new database table**
  2. **Sem, emp, lo.php**
    1. **Fix form validation**
    2. **Fix get data from database**
    3. **Fix redirection when click save or proceed**
  3. **Change design colors a little bit**

**Secretary Page**

1. **Functions**
  1. **Create Mass Users**
  2. **Modify/View Courses**
  3. **View Departments**

**Records and Registration Page**

- **Responsibilities**
  - **(Review entire application information, chair/dean/faculty/employer decisions)**

**Career Resource Center Page**

- **Responsibilities**
  - Review entire application
  - **Export data to file**
  - **Create account for faculty**
  - **Create academic department**

**Dean Page**

- **Responsibilities**
  - **Approve/Deny application**
  - **Optional: add excess academic credit**

**Chair Page**

- **Responsibilities**
  - **Review full application (accept/reject)**

**Employer Page**

- **Responsibilities**
  - **Review learning objectives (accept/edit/reject)**

**Faculty Advisor/ Instructor**

- **Responsibilities**
  - **Review student application (accept/edit/reject)**
  - **Review employer information(accept/reject)**
  - **Add learning objectives**
  - **Upload syllabus**
  - **Final review and submit**

**Forget Page:**

1. **Complete its transaction**
