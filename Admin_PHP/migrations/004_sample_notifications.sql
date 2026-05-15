-- Sample data for notifications table
INSERT INTO `notifications` (`staff_id`, `project_id`, `title`, `message`, `type`, `status`, `created_at`) VALUES
(1, 101, 'Project Assigned', 'You have been assigned to Project Alpha.', 'assignment', 'unread', NOW()),
(2, 102, 'Task Deadline', 'The deadline for your task is approaching.', 'reminder', 'unread', NOW()),
(3, 103, 'Project Update', 'Project Beta has a new update.', 'update', 'read', NOW()),
(NULL, NULL, 'System Maintenance', 'The system will be down for maintenance tonight.', 'system', 'unread', NOW());
