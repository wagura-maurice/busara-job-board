employer creates a job post:
can add and manage jobs..
job_db;
id, tittle, details, requirements, location, postDate, deadline, employer_id

employee makes application to posted job:
applications_db;
id,job_id, CV, email

employer See's the applicants for the said posted job:
queries the applications_db in relation to where applications_db.job_id is job_db.id

employee invites applicants for the interview:
employer sends email to applications_db.email where applications_db.job_id is job_db.id

employer_db:
id, username, email, passward, avatar, status