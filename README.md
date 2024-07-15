# UniCollab - Your One-Stop Platform for Collaborative University Projects

## About UniCollab

UniCollab is a web application designed to streamline and enhance the way university students collaborate on projects. It provides a centralized platform for group formation, task management, file sharing, and communication, all tailored specifically for the needs of students.

## Features

* **Group Creation and Management:** Easily form groups, invite members, assign roles (leader/member), and manage group settings.
* **Task Assignment and Tracking:** Create, assign, and track the progress of tasks within your group. Set deadlines, priorities, and monitor completion status.
* **Secure File Sharing and Version Control:** Upload and share project files securely within your group. Access previous versions of files with built-in version control.
* **Real-Time Chat and Group Messaging:** Communicate instantly with group members via real-time chat. Participate in group discussions and stay updated on project developments.
* **Document Collaboration:** Collaborate on documents simultaneously with your group members. Edit and revise documents in real-time, ensuring everyone is on the same page.
* **Seamless Integration with Gemini:** Leverage the power of Gemini, a large language model, to assist with research, brainstorming, and content generation.
* **Intuitive and User-Friendly Interface:** Enjoy a clean and intuitive interface designed for ease of use, making collaboration simple and efficient.

## Technology Stack
UniCollab is built on a modern and powerful technology stack:

* **Development Framework:** Laravel (PHP)
* **Front-End Technologies:** HTML, CSS, JavaScript, jQuery, Tailwind CSS, Alpine.js
* **Back-End Technologies:** PHP, AJAX, PYTHON
* **Database:** MySQL
* **Real-Time Communication:** Pusher
* **Code Highlighting:** Highlight.js
* **Version Control:** Git, GitHub
* **Other Tools:** StarUML (UML Modeling), Visual Studio Code (IDE), MySQL Workbench (Database Management), Gemini 1.5 Pro (AI API)

| HTTP Method | Route | Controller Action | Middleware | Description |
|---|---|---|---|---|
| GET | `/` | `WelcomeController@welcome` | `guest` | Displays the welcome page for guests. |
| GET | `/login` | `UserController@login` | `guest` | Displays the login page for guests. |
| POST | `/users` | `UserController@store` | `guest` | Stores new user information in the database. |
| POST | `/logout` | `UserController@logout` | `auth`, `verified` | Logs out the authenticated and verified user. |
| GET | `/profile` | `UserController@edit` | `auth`, `verified` | Displays the profile editing page for authenticated and verified users. |
| PUT | `/profile` | `UserController@update` | `auth`, `verified` | Updates the user's profile information. |
| POST | `/users/authenticate` | `UserController@authentication` |  | Authenticates the user's credentials. |
| GET | `/email/verify` | `EmailController@verify_email` | `auth` | Displays the email verification notice page for authenticated users. |
| GET | `/email/verify/{id}/{hash}` | `EmailController@handel_email_verification` | `auth`, `signed` | Handles the email verification process. |
| GET | `/home` | `GroupController@index` | `auth`, `verified` | Displays the main page with group listing for authenticated and verified users. |
| POST | `/group/creat` | `GroupController@store` | `auth`, `verified` | Creates a new group. |
| POST | `/group/join` | `GroupController@join` | `auth`, `verified` | Allows a user to join a group. |
| GET | `/group/{group}` | `GroupController@show` | `auth`, `verified`, `member` | Displays the details of a specific group. |
| POST | `/group/{group}/leave` | `GroupController@leave` | `auth`, `verified`, `member` | Allows a member to leave a group. |
| GET | `/group/{group}/modify` | `GroupController@edit` | `auth`, `verified`, `member`, `leader` | Displays the group modification page for the group leader. |
| PUT | `/group/{group}/modify` | `GroupController@update` | `auth`, `verified`, `member`, `leader` | Updates the group's information. |
| GET | `/group/{group}/invitations` | `InvitationController@index` | `auth`, `verified`, `member`, `leader` | Displays the group invitations page for the group leader. |
| POST | `/group/{group}/invitations/{user}` | `InvitationController@response` | `auth`, `verified`, `member`, `leader` | Handles the response to a group invitation. |
| GET | `/group/{group}/documents` | `DocumentController@index` | `auth`, `verified`, `member` | Lists all documents within a group. |
| POST | `/group/{group}/documents` | `DocumentController@store` | `auth`, `verified`, `member` | Uploads and stores a new document in the group. |
| DELETE | `/group/{group}/documents/{document}` | `DocumentController@delete` | `auth`, `verified`, `member` | Deletes a document from the group. |
| GET | `/group/{group}/document/{document}` | `DocumentController@show` | `auth`, `verified`, `member` | Displays the content of a specific document. |
| GET | `/group/{group}/projects` | `FileController@index` | `auth`, `verified`, `member` | Lists all project files within a group. |
| GET | `/group/{group}/projects/zip` | `FileController@zip` | `auth`, `verified`, `member` | Downloads all project files as a ZIP archive. |
| GET | `/group/{group}/projects/{file}` | `FileController@show` | `auth`, `verified`, `member` | Displays or downloads a specific project file. |
| DELETE | `/group/{group}/projects/{file}` | `FileController@delete` | `auth`, `verified`, `member`, `leader` | Deletes a project file from the group. |
| GET | `/group/{group}/projects/{file}/{version}` | `FileController@show_version` | `auth`, `verified`, `member` | Displays or downloads a specific version of a project file. |
| POST | `/group/{group}/projects` | `FileController@store` | `auth`, `verified`, `member`, `leader` | Uploads and stores a new project file in the group. |
| GET | `/group/{group}/kick_out/{user}` | `GroupController@kick_out` | `auth`, `verified`, `leader` | Removes a member from a group. |
| GET | `/group/{group}/task` | `TaskController@index` | `auth`, `verified`, `member` | Lists all tasks within a group. |
| GET | `/group/{group}/task/create` | `TaskController@create` | `auth`, `verified`, `member`, `leader` | Displays the task creation page. |
| POST | `/group/{group}/task` | `TaskController@store` | `auth`, `verified`, `member`, `leader` | Creates a new task within a group. |
| GET | `/group/{group}/task/{task}` | `TaskController@show` | `auth`, `verified`, `member` | Displays the details of a specific task. |
| POST | `/group/{group}/task/{task}` | `TaskController@respond` | `auth`, `verified`, `member` | Allows a member to respond to a task. |
| PUT | `/group/{group}/task/{task}` | `TaskController@answer` | `auth`, `verified`, `member`, `leader` | Allows the group leader to mark a task as answered. |
| DELETE | `/group/{group}/task/{task}` | `TaskController@delete` | `auth`, `verified`, `member`, `leader` | Deletes a task from the group. |
| GET | `/group/{group}/task/{task}/show/{taskfile}` | `TaskfileController@show` | `auth`, `verified`, `member` | Displays or downloads a file associated with a task. |
| GET | `/group/{group}/chat` | `GroupmessageController@index` | `auth`, `verified`, `member` | Displays the group chat interface. |
| POST | `/group/{group}/chat` | `GroupmessageController@send` | `auth`, `verified`, `member` | Sends a message to the group chat. |
| POST | `/group/{group}/chat/receive` | `GroupmessageController@recive` | `auth`, `verified`, `member` | Receives messages for the group chat. |
| GET | `/group/{group}/chat/{user}` | `ChatController@index` | `auth`, `verified`, `member` | Displays the private chat interface with a specific user within the group. |
| POST | `/group/{group}/chat/{user}` | `ChatController@send` | `auth`, `verified`, `member` | Sends a message to a specific user within the group. |
| POST | `/seen` | `ChatController@seen` | `auth`, `verified` | Marks messages as seen in a private chat. |
| GET | `/group/{group}/gemini` | `GeminiController@index` | `auth`, `verified` | Displays the Gemini integration interface. |
| POST | `/group/{group}/gemini` | `GeminiController@send` | `auth`, `verified` | Sends a request to the Gemini API. |
| DELETE | `/group` | `GroupController@delete` | `auth`, `verified`, `leader` | Deletes a group. |
| POST | `/admin/login` | `AdminiController@authentication` |  | Authenticates the admin user. |
| GET | `/admin/dashboard` | `AdminiController@index` | `admin` | Displays the admin dashboard. |
| GET | `/admin/login` | `AdminiController@login` |  | Displays the admin login page. |
| GET | `/admin/logout` | `AdminiController@logout` | `admin` | Logs out the admin user. |
| GET | `/admin/profile` | `AdminiController@profile` | `admin` | Displays the admin profile page. |
| PUT | `/admin/profile` | `AdminiController@update` | `admin` | Updates the admin profile information. |
| GET | `/admin/user/remove/{user}` | `AdminiController@removeUser` | `admin` | Removes a user from the platform. |
| GET | `/admin/group/remove/{group}` | `AdminiController@removeGroup` | `admin` | Removes a group from the platform. |

**Note:** This table summarizes the routes defined in the provided code snippet. It's possible that the actual application may have additional routes or modifications depending on its complete implementation. 


## Installation

1. Clone the repository: 

   ```bash
   git clone https://github.com/your-username/UniCollab.git
   ```

2. Install dependencies using Composer:

   ```bash
   composer install
   ```

3. Configure the environment variables:

   - Create a copy of the `.env.example` file and rename it to `.env`.
   - Update the `.env` file with your database credentials and other relevant settings.

4. Generate an application key:

   ```bash
   php artisan key:generate
   ```

5. Run the database migrations:

   ```bash
   php artisan migrate
   ```

## Usage

1. Start the development server:

   ```bash
   php artisan serve
   ```

2. Access the application in your web browser at `http://localhost:8000`.

## Contributing

Contributions are welcome! Please open an issue or submit a pull request if you have any improvements or bug fixes.

## Future Enhancements
We have exciting plans for future enhancements, including:

* Advanced group management with role-based access control.
* Enhanced real-time communication features like video conferencing and screen sharing.
* Integration with third-party tools for a seamless workflow.
* Gamification elements to motivate and engage users.

## License

This project is licensed under the [MIT License](LICENSE).
