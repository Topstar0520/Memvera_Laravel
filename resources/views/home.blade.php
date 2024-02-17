@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Memvera Marketing Campaign Module</div>

                <div class="card-body">

                    <b>Objective:</b><br>
                    The objective of the Memvera Marketing Campaign Module technical assessment is to evaluate your skills in developing a Laravel application feature for managing marketing campaigns, including the ability to send emails to individuals or bulk recipients. <br>
                    Additionally, you will be tasked with implementing scheduling functionality to automate email sending based on birth dates, running daily. <br>
                    You will need to design and implement the necessary database tables to store member information, campaign details, and email sending records.<br>
                    <br>
                    <b>Requirements:</b><br>
                    <br>
                    1. Database Design: Design the database schema including tables for:<br>
                    - Members: Store information about individuals including their name, email, and birth date.<br>
                    - Campaigns: Store details about email campaigns including campaign name, subject, content, and any additional relevant information.<br>
                    - Emails Sent: Store records of emails sent, including the recipient(s), campaign ID, sending date, and any relevant status or logs.<br>
                    <br>
                    2. Laravel Application Setup:<br>
                    - Initialize a new Laravel application.<br>
                    - Set up database configuration and migrations for the tables designed in the previous step.<br>
                    <br>
                    3. Backend Development:<br>
                    - Implement CRUD (Create, Read, Update, Delete) functionality for managing members and campaigns.<br>
                    - Develop a module to send emails to individual or bulk recipients using Laravel's email sending functionality.<br>
                    - Implement scheduling functionality to automatically send emails based on members' birth dates, running daily. <br>
                    Ensure that emails are sent only to members whose birth date matches the current date.<br>
                    <br>
                    4. Technology Stack:<br>
                    - Laravel PHP Framework<br>
                    - MySQL or any preferred relational database management system (RDBMS)<br>
                    - HTML, CSS (for optional frontend development)<br>
                    - Bootstrap or any preferred frontend framework (for optional frontend development)<br>
                    <br>
                    <b>Evaluation Criteria:</b><br>
                    <br>- Database Design: Accuracy of the database schema design and efficiency in handling the required data.
                    <br>- Backend Development:
                    <br>- Implementation of CRUD functionalities.
                    <br>- Correct integration of Laravel's email sending functionality.
                    <br>- Accuracy and reliability of the scheduling mechanism.
                    <br>- Frontend Development (if applicable):
                    <br>- Clarity and usability of the frontend views.
                    <br>- Testing:
                    <br>- Thoroughness of unit tests.
                    <br>- Successful completion of manual testing scenarios.
                    <br>
                    <br><b>Submission Guidelines:</b><br>
                    <br>- You are required to submit your codebase along with relevant documentation, including instructions for setting up and running the <br>application.
                    <br>- Your submission should be organized and well-commented for clarity and understanding.
                    <br>
                    <br><b>Deadline:</b><br>
                    <br>- The deadline for completing this assessment is 17-02-2024.
                    <br>- If you encounter any issues or need clarification on requirements, please feel free to reach out for assistance.
                    <br>
                    <br>Best of luck, and we look forward to reviewing your work!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
