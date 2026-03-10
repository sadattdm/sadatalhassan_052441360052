-- Insert 21 sample courses into the courses table
INSERT INTO courses (course_code, course_title, credit_hours, level, department, description, is_active) VALUES

-- Level 100 (First Year)
('CS101', 'Introduction to Programming', 3, '100', 'Computer Science', 'Fundamentals of programming using Python, variables, loops, functions and basic problem solving.', 1),
('MATH101', 'Algebra and Trigonometry', 3, '100', 'Mathematics', 'Basic algebra, functions, trigonometry, sequences and series.', 1),
('COMM101', 'Communication Skills I', 3, '100', 'Communication Studies', 'Effective reading, writing, listening and speaking skills for academic purposes.', 1),
('PHYS101', 'General Physics I', 3, '100', 'Physics', 'Mechanics, motion, forces, energy and momentum.', 1),
('BIO101', 'General Biology I', 3, '100', 'Biological Sciences', 'Cell biology, genetics, evolution and diversity of life.', 1),

-- Level 200 (Second Year)
('CS201', 'Data Structures & Algorithms', 3, '200', 'Computer Science', 'Arrays, linked lists, stacks, queues, trees, sorting and searching algorithms.', 1),
('MATH201', 'Calculus I', 4, '200', 'Mathematics', 'Limits, derivatives, integrals and applications.', 1),
('STAT201', 'Introduction to Statistics', 3, '200', 'Statistics', 'Descriptive statistics, probability, distributions, hypothesis testing.', 1),
('ACCT201', 'Financial Accounting I', 3, '200', 'Accounting', 'Basic accounting principles, double-entry system, financial statements.', 1),
('ECON201', 'Principles of Microeconomics', 3, '200', 'Economics', 'Supply and demand, market structures, consumer behavior.', 1),

-- Level 300 (Third Year)
('CS301', 'Database Systems', 3, '300', 'Computer Science', 'Relational databases, SQL, normalization, ER modeling, transactions.', 1),
('CS302', 'Web Development', 3, '300', 'Computer Science', 'HTML, CSS, JavaScript, PHP, responsive design basics.', 1),
('CS303', 'Operating Systems', 3, '300', 'Computer Science', 'Processes, threads, memory management, file systems, scheduling.', 1),
('MKT301', 'Principles of Marketing', 3, '300', 'Marketing', 'Marketing mix, consumer behavior, market segmentation.', 1),
('HRM301', 'Human Resource Management', 3, '300', 'Human Resource Management', 'Recruitment, training, performance appraisal, employee relations.', 1),

-- Level 400 (Final Year)
('CS401', 'Software Engineering', 3, '400', 'Computer Science', 'Software development life cycle, requirements, design patterns, testing.', 1),
('CS402', 'Artificial Intelligence', 3, '400', 'Computer Science', 'Search algorithms, knowledge representation, machine learning basics.', 1),
('CS403', 'Computer Networks', 3, '400', 'Computer Science', 'OSI model, TCP/IP, routing, LAN/WAN technologies.', 1),
('BUS401', 'Business Policy & Strategy', 3, '400', 'Business Administration', 'Strategic management, competitive advantage, corporate strategy.', 1),
('FIN401', 'Corporate Finance', 3, '400', 'Finance', 'Time value of money, capital budgeting, risk and return.', 1),
('LAW401', 'Business Law', 3, '400', 'Law', 'Contracts, company law, commercial transactions, intellectual property.', 1);