CREATE DATABASE student_result_management;
USE student_result_management;

CREATE TABLE batch (
    batch_id INT AUTO_INCREMENT PRIMARY KEY,
    batch_name VARCHAR(20) NOT NULL
);

INSERT INTO batch (batch_id, batch_name) VALUES
(61,'CSE-61'),
(62,'CSE-62'),
(63,'CSE-63'),
(64,'CSE-64');


CREATE TABLE student (
    student_id VARCHAR(20) PRIMARY KEY,
    student_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(20),
    batch_id INT,
    FOREIGN KEY (batch_id) REFERENCES batch(batch_id)
);



INSERT INTO student (student_id, student_name, email, phone, batch_id) VALUES
('242-0001','Rakib Hasan','rakib.hasan61@gmail.com','01711000001',61),
('242-0002','Fahim Ahmed','fahim.ahmed61@gmail.com','01711000002',61),
('242-0003','Nafis Islam','nafis.islam61@gmail.com','01711000003',61),
('242-0004','Siam Rahman','siam.rahman61@gmail.com','01711000004',61),
('242-0005','Tamim Hossain','tamim.hossain61@gmail.com','01711000005',61),
('242-0006','Mahin Chowdhury','mahin.chowdhury61@gmail.com','01711000006',61),
('242-0007','Sabbir Ahmed','sabbir.ahmed61@gmail.com','01711000007',61),
('242-0008','Shahriar Kabir','shahriar.kabir61@gmail.com','01711000008',61),
('242-0009','Raihan Islam','raihan.islam61@gmail.com','01711000009',61),
('242-0010','Arif Hossain','arif.hossain61@gmail.com','01711000010',61),
('242-0011','Sakib Khan','sakib.khan61@gmail.com','01711000011',61),
('242-0012','Nayeem Islam','nayeem.islam61@gmail.com','01711000012',61),
('242-0013','Jubayer Ahmed','jubayer.ahmed61@gmail.com','01711000013',61),
('242-0014','Mizanur Rahman','mizan.rahman61@gmail.com','01711000014',61),
('242-0015','Arafat Hossain','arafat.hossain61@gmail.com','01711000015',61),
('242-0016','Hasibul Islam','hasib.islam61@gmail.com','01711000016',61),
('242-0017','Ashraful Alam','ashraful.alam61@gmail.com','01711000017',61),
('242-0018','Rifat Hasan','rifat.hasan61@gmail.com','01711000018',61),
('242-0019','Shuvo Roy','shuvo.roy61@gmail.com','01711000019',61),
('242-0020','Mehedi Hasan','mehedi.hasan61@gmail.com','01711000020',61),
('242-0021','Abdullah Al Mamun','abdullah.mamun61@gmail.com','01711000021',61),
('242-0022','Asif Iqbal','asif.iqbal61@gmail.com','01711000022',61),
('242-0023','Tanvir Ahmed','tanvir.ahmed61@gmail.com','01711000023',61),
('242-0024','Fardin Islam','fardin.islam61@gmail.com','01711000024',61),
('242-0025','Imran Hossain','imran.hossain61@gmail.com','01711000025',61),
('242-0026','Sajid Rahman','sajid.rahman61@gmail.com','01711000026',61),
('242-0027','Sohan Ahmed','sohan.ahmed61@gmail.com','01711000027',61),
('242-0028','Nabil Hasan','nabil.hasan61@gmail.com','01711000028',61),
('242-0029','Tanzim Islam','tanzim.islam61@gmail.com','01711000029',61),
('242-0030','Farhan Chowdhury','farhan.chowdhury61@gmail.com','01711000030',61),
('242-0031','Rezaul Karim','rezaul.karim61@gmail.com','01711000031',61),
('242-0032','Rony Hossain','rony.hossain61@gmail.com','01711000032',61),
('242-0033','Saif Ahmed','saif.ahmed61@gmail.com','01711000033',61),
('242-0034','Noman Islam','noman.islam61@gmail.com','01711000034',61),
('242-0035','Mahmudul Hasan','mahmudul.hasan61@gmail.com','01711000035',61),
('242-0036','Shakil Ahmed','shakil.ahmed61@gmail.com','01711000036',61),
('242-0037','Rasel Khan','rasel.khan61@gmail.com','01711000037',61),
('242-0038','Moshiur Rahman','moshiur.rahman61@gmail.com','01711000038',61),
('242-0039','Nahid Hasan','nahid.hasan61@gmail.com','01711000039',61),
('242-0040','Saklain Islam','saklain.islam61@gmail.com','01711000040',61),
('242-0041','Adnan Hossain','adnan.hossain61@gmail.com','01711000041',61),
('242-0042','Shahin Ahmed','shahin.ahmed61@gmail.com','01711000042',61),
('242-0043','Tariqul Islam','tariqul.islam61@gmail.com','01711000043',61),
('242-0044','Anik Rahman','anik.rahman61@gmail.com','01711000044',61),
('242-0045','Masud Rana','masud.rana61@gmail.com','01711000045',61),
('242-0046','Siam Ahmed','siam.ahmed61@gmail.com','01711000046',61),
('242-0047','Riad Hasan','riad.hasan61@gmail.com','01711000047',61),
('242-0048','Shafin Islam','shafin.islam61@gmail.com','01711000048',61),
('242-0049','Arman Hossain','arman.hossain61@gmail.com','01711000049',61),
('242-0050','Foysal Ahmed','foysal.ahmed61@gmail.com','01711000050',61);


INSERT INTO student (student_id, student_name, email, phone, batch_id) VALUES
('243-0001','Aminul Islam','aminul.islam62@gmail.com','01811000001',62),
('243-0002','Nahid Hossain','nahid.hossain62@gmail.com','01811000002',62),
('243-0003','Sajib Ahmed','sajib.ahmed62@gmail.com','01811000003',62),
('243-0004','Tanvir Hasan','tanvir.hasan62@gmail.com','01811000004',62),
('243-0005','Mahfuz Rahman','mahfuz.rahman62@gmail.com','01811000005',62),
('243-0006','Jahidul Islam','jahidul.islam62@gmail.com','01811000006',62),
('243-0007','Rafsan Ahmed','rafsan.ahmed62@gmail.com','01811000007',62),
('243-0008','Imtiaz Hossain','imtiaz.hossain62@gmail.com','01811000008',62),
('243-0009','Sayeed Hasan','sayeed.hasan62@gmail.com','01811000009',62),
('243-0010','Mushfiq Rahman','mushfiq.rahman62@gmail.com','01811000010',62),
('243-0011','Riad Karim','riad.karim62@gmail.com','01811000011',62),
('243-0012','Fardin Ahmed','fardin.ahmed62@gmail.com','01811000012',62),
('243-0013','Shakib Hasan','shakib.hasan62@gmail.com','01811000013',62),
('243-0014','Tawsif Islam','tawsif.islam62@gmail.com','01811000014',62),
('243-0015','Nafiz Rahman','nafiz.rahman62@gmail.com','01811000015',62),
('243-0016','Ariful Islam','ariful.islam62@gmail.com','01811000016',62),
('243-0017','Shawon Hossain','shawon.hossain62@gmail.com','01811000017',62),
('243-0018','Mahadi Hasan','mahadi.hasan62@gmail.com','01811000018',62),
('243-0019','Rakibul Alam','rakibul.alam62@gmail.com','01811000019',62),
('243-0020','Sabbir Rahman','sabbir.rahman62@gmail.com','01811000020',62),
('243-0021','Ashik Ahmed','ashik.ahmed62@gmail.com','01811000021',62),
('243-0022','Mizan Hossain','mizan.hossain62@gmail.com','01811000022',62),
('243-0023','Jubayer Hasan','jubayer.hasan62@gmail.com','01811000023',62),
('243-0024','Rifat Rahman','rifat.rahman62@gmail.com','01811000024',62),
('243-0025','Tamjid Islam','tamjid.islam62@gmail.com','01811000025',62),
('243-0026','Sohan Karim','sohan.karim62@gmail.com','01811000026',62),
('243-0027','Nayeem Ahmed','nayeem.ahmed62@gmail.com','01811000027',62),
('243-0028','Mahim Hasan','mahim.hasan62@gmail.com','01811000028',62),
('243-0029','Adnan Rahman','adnan.rahman62@gmail.com','01811000029',62),
('243-0030','Tariq Islam','tariq.islam62@gmail.com','01811000030',62),
('243-0031','Sakib Mahmud','sakib.mahmud62@gmail.com','01811000031',62),
('243-0032','Shafin Ahmed','shafin.ahmed62@gmail.com','01811000032',62),
('243-0033','Masud Rana','masud.rana62@gmail.com','01811000033',62),
('243-0034','Foysal Hossain','foysal.hossain62@gmail.com','01811000034',62),
('243-0035','Rasel Islam','rasel.islam62@gmail.com','01811000035',62),
('243-0036','Noman Karim','noman.karim62@gmail.com','01811000036',62),
('243-0037','Anik Hasan','anik.hasan62@gmail.com','01811000037',62),
('243-0038','Muntasir Rahman','muntasir.rahman62@gmail.com','01811000038',62),
('243-0039','Farhan Ahmed','farhan.ahmed62@gmail.com','01811000039',62),
('243-0040','Rony Islam','rony.islam62@gmail.com','01811000040',62),
('243-0041','Hasib Karim','hasib.karim62@gmail.com','01811000041',62),
('243-0042','Shuvo Hasan','shuvo.hasan62@gmail.com','01811000042',62),
('243-0043','Saif Rahman','saif.rahman62@gmail.com','01811000043',62),
('243-0044','Nabil Ahmed','nabil.ahmed62@gmail.com','01811000044',62),
('243-0045','Raihan Islam','raihan.islam62@gmail.com','01811000045',62),
('243-0046','Shahriar Hossain','shahriar.hossain62@gmail.com','01811000046',62),
('243-0047','Tanzim Hasan','tanzim.hasan62@gmail.com','01811000047',62),
('243-0048','Saklain Rahman','saklain.rahman62@gmail.com','01811000048',62),
('243-0049','Mahbub Ahmed','mahbub.ahmed62@gmail.com','01811000049',62),
('243-0050','Arafat Islam','arafat.islam62@gmail.com','01811000050',62);


INSERT INTO student (student_id, student_name, email, phone, batch_id) VALUES
('244-0001','Shahadat Hossain','shahadat.hossain63@gmail.com','01911000001',63),
('244-0002','Naimur Rahman','naimur.rahman63@gmail.com','01911000002',63),
('244-0003','Fahad Ahmed','fahad.ahmed63@gmail.com','01911000003',63),
('244-0004','Ratul Islam','ratul.islam63@gmail.com','01911000004',63),
('244-0005','Mehedi Rahman','mehedi.rahman63@gmail.com','01911000005',63),
('244-0006','Shakil Hasan','shakil.hasan63@gmail.com','01911000006',63),
('244-0007','Nabil Hossain','nabil.hossain63@gmail.com','01911000007',63),
('244-0008','Arman Ahmed','arman.ahmed63@gmail.com','01911000008',63),
('244-0009','Tawhid Islam','tawhid.islam63@gmail.com','01911000009',63),
('244-0010','Samiul Rahman','samiul.rahman63@gmail.com','01911000010',63),
('244-0011','Junaid Hasan','junaid.hasan63@gmail.com','01911000011',63),
('244-0012','Mahmud Ahmed','mahmud.ahmed63@gmail.com','01911000012',63),
('244-0013','Sajjad Hossain','sajjad.hossain63@gmail.com','01911000013',63),
('244-0014','Rifat Karim','rifat.karim63@gmail.com','01911000014',63),
('244-0015','Adib Rahman','adib.rahman63@gmail.com','01911000015',63),
('244-0016','Hasan Mahmud','hasan.mahmud63@gmail.com','01911000016',63),
('244-0017','Tanmoy Islam','tanmoy.islam63@gmail.com','01911000017',63),
('244-0018','Fardin Hossain','fardin.hossain63@gmail.com','01911000018',63),
('244-0019','Sabbir Karim','sabbir.karim63@gmail.com','01911000019',63),
('244-0020','Nafis Ahmed','nafis.ahmed63@gmail.com','01911000020',63),
('244-0021','Rayan Hasan','rayan.hasan63@gmail.com','01911000021',63),
('244-0022','Shihab Rahman','shihab.rahman63@gmail.com','01911000022',63),
('244-0023','Ashfaq Islam','ashfaq.islam63@gmail.com','01911000023',63),
('244-0024','Sakib Hossain','sakib.hossain63@gmail.com','01911000024',63),
('244-0025','Farabi Ahmed','farabi.ahmed63@gmail.com','01911000025',63),
('244-0026','Rasel Rahman','rasel.rahman63@gmail.com','01911000026',63),
('244-0027','Mahin Islam','mahin.islam63@gmail.com','01911000027',63),
('244-0028','Riad Karim','riad.karim63@gmail.com','01911000028',63),
('244-0029','Shuvo Ahmed','shuvo.ahmed63@gmail.com','01911000029',63),
('244-0030','Tamim Hasan','tamim.hasan63@gmail.com','01911000030',63),
('244-0031','Imran Rahman','imran.rahman63@gmail.com','01911000031',63),
('244-0032','Arian Islam','arian.islam63@gmail.com','01911000032',63),
('244-0033','Shafin Hossain','shafin.hossain63@gmail.com','01911000033',63),
('244-0034','Rafid Ahmed','rafid.ahmed63@gmail.com','01911000034',63),
('244-0035','Sajib Hasan','sajib.hasan63@gmail.com','01911000035',63),
('244-0036','Nayeem Rahman','nayeem.rahman63@gmail.com','01911000036',63),
('244-0037','Tariqul Islam','tariqul.islam63@gmail.com','01911000037',63),
('244-0038','Anik Hossain','anik.hossain63@gmail.com','01911000038',63),
('244-0039','Jubayer Ahmed','jubayer.ahmed63@gmail.com','01911000039',63),
('244-0040','Rony Hasan','rony.hasan63@gmail.com','01911000040',63),
('244-0041','Saif Rahman','saif.rahman63@gmail.com','01911000041',63),
('244-0042','Noman Islam','noman.islam63@gmail.com','01911000042',63),
('244-0043','Muntasir Ahmed','muntasir.ahmed63@gmail.com','01911000043',63),
('244-0044','Sohan Karim','sohan.karim63@gmail.com','01911000044',63),
('244-0045','Adnan Hossain','adnan.hossain63@gmail.com','01911000045',63),
('244-0046','Mahadi Hasan','mahadi.hasan63@gmail.com','01911000046',63),
('244-0047','Shahriar Rahman','shahriar.rahman63@gmail.com','01911000047',63),
('244-0048','Raiyan Ahmed','raiyan.ahmed63@gmail.com','01911000048',63),
('244-0049','Foysal Islam','foysal.islam63@gmail.com','01911000049',63),
('244-0050','Tanzim Hossain','tanzim.hossain63@gmail.com','01911000050',63);


INSERT INTO student (student_id, student_name, email, phone, batch_id) VALUES
('245-0001','Abir Hasan','abir.hasan64@gmail.com','01611000001',64),
('245-0002','Fahim Rahman','fahim.rahman64@gmail.com','01611000002',64),
('245-0003','Rakib Ahmed','rakib.ahmed64@gmail.com','01611000003',64),
('245-0004','Nafis Hossain','nafis.hossain64@gmail.com','01611000004',64),
('245-0005','Siam Islam','siam.islam64@gmail.com','01611000005',64),
('245-0006','Mahin Karim','mahin.karim64@gmail.com','01611000006',64),
('245-0007','Tanvir Hasan','tanvir.hasan64@gmail.com','01611000007',64),
('245-0008','Rifat Rahman','rifat.rahman64@gmail.com','01611000008',64),
('245-0009','Sabbir Ahmed','sabbir.ahmed64@gmail.com','01611000009',64),
('245-0010','Jubayer Islam','jubayer.islam64@gmail.com','01611000010',64),
('245-0011','Shakib Hossain','shakib.hossain64@gmail.com','01611000011',64),
('245-0012','Raihan Hasan','raihan.hasan64@gmail.com','01611000012',64),
('245-0013','Adnan Rahman','adnan.rahman64@gmail.com','01611000013',64),
('245-0014','Nayeem Ahmed','nayeem.ahmed64@gmail.com','01611000014',64),
('245-0015','Muntasir Karim','muntasir.karim64@gmail.com','01611000015',64),
('245-0016','Anik Islam','anik.islam64@gmail.com','01611000016',64),
('245-0017','Sakib Hasan','sakib.hasan64@gmail.com','01611000017',64),
('245-0018','Mahmud Hossain','mahmud.hossain64@gmail.com','01611000018',64),
('245-0019','Rony Ahmed','rony.ahmed64@gmail.com','01611000019',64),
('245-0020','Farhan Rahman','farhan.rahman64@gmail.com','01611000020',64),
('245-0021','Tariq Islam','tariq.islam64@gmail.com','01611000021',64),
('245-0022','Hasib Karim','hasib.karim64@gmail.com','01611000022',64),
('245-0023','Saif Hasan','saif.hasan64@gmail.com','01611000023',64),
('245-0024','Shafin Ahmed','shafin.ahmed64@gmail.com','01611000024',64),
('245-0025','Arafat Hossain','arafat.hossain64@gmail.com','01611000025',64),
('245-0026','Rasel Rahman','rasel.rahman64@gmail.com','01611000026',64),
('245-0027','Sohan Islam','sohan.islam64@gmail.com','01611000027',64),
('245-0028','Mahadi Hasan','mahadi.hasan64@gmail.com','01611000028',64),
('245-0029','Foysal Ahmed','foysal.ahmed64@gmail.com','01611000029',64),
('245-0030','Nabil Karim','nabil.karim64@gmail.com','01611000030',64),
('245-0031','Shuvo Rahman','shuvo.rahman64@gmail.com','01611000031',64),
('245-0032','Riad Islam','riad.islam64@gmail.com','01611000032',64),
('245-0033','Tamim Hasan','tamim.hasan64@gmail.com','01611000033',64),
('245-0034','Jahid Ahmed','jahid.ahmed64@gmail.com','01611000034',64),
('245-0035','Sajid Hossain','sajid.hossain64@gmail.com','01611000035',64),
('245-0036','Arif Rahman','arif.rahman64@gmail.com','01611000036',64),
('245-0037','Noman Islam','noman.islam64@gmail.com','01611000037',64),
('245-0038','Rafsan Hasan','rafsan.hasan64@gmail.com','01611000038',64),
('245-0039','Ashik Ahmed','ashik.ahmed64@gmail.com','01611000039',64),
('245-0040','Imran Karim','imran.karim64@gmail.com','01611000040',64),
('245-0041','Shahriar Rahman','shahriar.rahman64@gmail.com','01611000041',64),
('245-0042','Saklain Islam','saklain.islam64@gmail.com','01611000042',64),
('245-0043','Mahfuz Hasan','mahfuz.hasan64@gmail.com','01611000043',64),
('245-0044','Rayan Ahmed','rayan.ahmed64@gmail.com','01611000044',64),
('245-0045','Tanzim Hossain','tanzim.hossain64@gmail.com','01611000045',64),
('245-0046','Moshiur Rahman','moshiur.rahman64@gmail.com','01611000046',64),
('245-0047','Adib Islam','adib.islam64@gmail.com','01611000047',64),
('245-0048','Ratul Hasan','ratul.hasan64@gmail.com','01611000048',64),
('245-0049','Nafiz Ahmed','nafiz.ahmed64@gmail.com','01611000049',64),
('245-0050','Shakil Karim','shakil.karim64@gmail.com','01611000050',64);




CREATE TABLE teacher (
    teacher_id INT AUTO_INCREMENT PRIMARY KEY,
    teacher_name VARCHAR(100) NOT NULL,
    designation VARCHAR(50),
    email VARCHAR(100) UNIQUE
);

INSERT INTO teacher (teacher_name, designation) VALUES
('Dr. Md. Ashraful Islam', 'Professor'),
('Dr. Farhana Yasmin', 'Associate Professor'),
('Dr. Mohammad Ali', 'Associate Professor'),
('Md. Saiful Islam', 'Assistant Professor'),
('Mahmudul Hasan', 'Assistant Professor'),
('Nusrat Jahan', 'Lecturer'),
('Shahriar Kabir', 'Lecturer'),
('Tanvir Ahmed', 'Lecturer'),
('Sadia Afrin', 'Lecturer'),
('Muntasir Rahman', 'Lecturer');


ALTER TABLE teacher
ADD password VARCHAR(100) NOT NULL;

UPDATE teacher
SET email='ashraful@mu.edu.bd',
    password='12345'
WHERE teacher_id=1;

UPDATE teacher
SET email='farhana@mu.edu.bd',
    password='12345'
WHERE teacher_id=2;

UPDATE teacher
SET email='mohammadali@mu.edu.bd',
    password='12345'
WHERE teacher_id=3;

UPDATE teacher
SET email='saiful@mu.edu.bd',
    password='12345'
WHERE teacher_id=4;

UPDATE teacher
SET email='mahmudul@mu.edu.bd',
    password='12345'
WHERE teacher_id=5;


CREATE TABLE course (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_code VARCHAR(20) NOT NULL,
    course_name VARCHAR(100) NOT NULL,
    credit DECIMAL(3,1) NOT NULL,
    batch_id INT,
    FOREIGN KEY (batch_id) REFERENCES batch(batch_id)
);


INSERT INTO course (course_code, course_name, credit) VALUES

-- Batch 64
('CSE101', 'Structured Programming', 3.0),
('CSE102', 'Structured Programming Lab', 1.5),
('ENG101', 'English 1', 3.0),
('PHY101', 'Physics 1', 3.0),
('MTH101', 'Differential & Integral Calculus', 3.0),

-- Batch 63
('CSE201', 'Data Structure', 3.0),
('CSE202', 'Data Structure Lab', 1.5),
('ENG201', 'English 2', 3.0),
('PHY201', 'Physics 2', 3.0),
('MTH201', 'Differential Equation & Laplace Transform', 3.0),

-- Batch 62
('CSE301', 'Algorithm', 3.0),
('CSE302', 'Algorithm Lab', 1.5),
('STA301', 'Basic Statistics & Probability', 3.0),

-- Batch 61
('CSE401', 'Database Management System', 3.0),
('CSE402', 'Database Management System Lab', 1.5),
('CSE403', 'Microprocessor & Interface', 3.0),
('CSE404', 'Microprocessor & Interface Lab', 1.5),
('CSE405', 'Competitive Programming', 1.5);




CREATE TABLE semester (
    semester_id INT PRIMARY KEY,
    semester_name VARCHAR(30) NOT NULL
);


INSERT INTO semester (semester_id, semester_name) VALUES
(1, '1st Semester'),
(2, '2nd Semester'),
(3, '3rd Semester'),
(4, '4th Semester'),
(5, '5th Semester'),
(6, '6th Semester'),
(7, '7th Semester'),
(8, '8th Semester');



CREATE TABLE result (
    result_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20) NOT NULL,
    course_code VARCHAR(20) NOT NULL,
    course_name VARCHAR(100) NOT NULL,
    semester_id INT NOT NULL,
    marks DECIMAL(5,2) NOT NULL,
    grade VARCHAR(2) NOT NULL,
    grade_point DECIMAL(3,2) NOT NULL
);



INSERT INTO result
(student_id, course_code, course_name, semester_id, marks, grade, grade_point)
VALUES

('242-0001','CSE401','Database Management System',4,83,'A+',4.00),
('242-0001','CSE402','Database Management System Lab',4,76,'A',3.75),
('242-0001','CSE403','Microprocessor & Interface',4,71,'A-',3.50),
('242-0001','CSE404','Microprocessor & Interface Lab',4,68,'B+',3.25),
('242-0001','CSE405','Competitive Programming',4,62,'B',3.00),

('242-0002','CSE401','Database Management System',4,88,'A+',4.00),
('242-0002','CSE402','Database Management System Lab',4,82,'A+',4.00),
('242-0002','CSE403','Microprocessor & Interface',4,79,'A',3.75),
('242-0002','CSE404','Microprocessor & Interface Lab',4,74,'A-',3.50),
('242-0002','CSE405','Competitive Programming',4,70,'A-',3.50),

('242-0003','CSE401','Database Management System',4,77,'A',3.75),
('242-0003','CSE402','Database Management System Lab',4,73,'A-',3.50),
('242-0003','CSE403','Microprocessor & Interface',4,69,'B+',3.25),
('242-0003','CSE404','Microprocessor & Interface Lab',4,66,'B+',3.25),
('242-0003','CSE405','Competitive Programming',4,61,'B',3.00),

('242-0004','CSE401','Database Management System',4,92,'A+',4.00),
('242-0004','CSE402','Database Management System Lab',4,85,'A+',4.00),
('242-0004','CSE403','Microprocessor & Interface',4,80,'A+',4.00),
('242-0004','CSE404','Microprocessor & Interface Lab',4,78,'A',3.75),
('242-0004','CSE405','Competitive Programming',4,74,'A-',3.50),

('242-0005','CSE401','Database Management System',4,68,'B+',3.25),
('242-0005','CSE402','Database Management System Lab',4,72,'A-',3.50),
('242-0005','CSE403','Microprocessor & Interface',4,75,'A',3.75),
('242-0005','CSE404','Microprocessor & Interface Lab',4,70,'A-',3.50),
('242-0005','CSE405','Competitive Programming',4,65,'B+',3.25),

('242-0006','CSE401','Database Management System',4,81,'A+',4.00),
('242-0006','CSE402','Database Management System Lab',4,78,'A',3.75),
('242-0006','CSE403','Microprocessor & Interface',4,73,'A-',3.50),
('242-0006','CSE404','Microprocessor & Interface Lab',4,69,'B+',3.25),
('242-0006','CSE405','Competitive Programming',4,67,'B+',3.25),

('242-0007','CSE401','Database Management System',4,74,'A-',3.50),
('242-0007','CSE402','Database Management System Lab',4,71,'A-',3.50),
('242-0007','CSE403','Microprocessor & Interface',4,68,'B+',3.25),
('242-0007','CSE404','Microprocessor & Interface Lab',4,64,'B',3.00),
('242-0007','CSE405','Competitive Programming',4,60,'B',3.00),

('242-0008','CSE401','Database Management System',4,86,'A+',4.00),
('242-0008','CSE402','Database Management System Lab',4,84,'A+',4.00),
('242-0008','CSE403','Microprocessor & Interface',4,79,'A',3.75),
('242-0008','CSE404','Microprocessor & Interface Lab',4,75,'A',3.75),
('242-0008','CSE405','Competitive Programming',4,72,'A-',3.50),

('242-0009','CSE401','Database Management System',4,79,'A',3.75),
('242-0009','CSE402','Database Management System Lab',4,76,'A',3.75),
('242-0009','CSE403','Microprocessor & Interface',4,72,'A-',3.50),
('242-0009','CSE404','Microprocessor & Interface Lab',4,69,'B+',3.25),
('242-0009','CSE405','Competitive Programming',4,63,'B',3.00),

('242-0010','CSE401','Database Management System',4,90,'A+',4.00),
('242-0010','CSE402','Database Management System Lab',4,87,'A+',4.00),
('242-0010','CSE403','Microprocessor & Interface',4,82,'A+',4.00),
('242-0010','CSE404','Microprocessor & Interface Lab',4,78,'A',3.75),
('242-0010','CSE405','Competitive Programming',4,75,'A',3.75),

('242-0011','CSE401','Database Management System',4,84,'A+',4.00),
('242-0011','CSE402','Database Management System Lab',4,80,'A+',4.00),
('242-0011','CSE403','Microprocessor & Interface',4,76,'A',3.75),
('242-0011','CSE404','Microprocessor & Interface Lab',4,72,'A-',3.50),
('242-0011','CSE405','Competitive Programming',4,68,'B+',3.25),

('242-0012','CSE401','Database Management System',4,73,'A-',3.50),
('242-0012','CSE402','Database Management System Lab',4,70,'A-',3.50),
('242-0012','CSE403','Microprocessor & Interface',4,67,'B+',3.25),
('242-0012','CSE404','Microprocessor & Interface Lab',4,63,'B',3.00),
('242-0012','CSE405','Competitive Programming',4,60,'B',3.00),

('242-0013','CSE401','Database Management System',4,91,'A+',4.00),
('242-0013','CSE402','Database Management System Lab',4,86,'A+',4.00),
('242-0013','CSE403','Microprocessor & Interface',4,82,'A+',4.00),
('242-0013','CSE404','Microprocessor & Interface Lab',4,78,'A',3.75),
('242-0013','CSE405','Competitive Programming',4,74,'A-',3.50),

('242-0014','CSE401','Database Management System',4,78,'A',3.75),
('242-0014','CSE402','Database Management System Lab',4,74,'A-',3.50),
('242-0014','CSE403','Microprocessor & Interface',4,71,'A-',3.50),
('242-0014','CSE404','Microprocessor & Interface Lab',4,68,'B+',3.25),
('242-0014','CSE405','Competitive Programming',4,65,'B+',3.25),

('242-0015','CSE401','Database Management System',4,87,'A+',4.00),
('242-0015','CSE402','Database Management System Lab',4,83,'A+',4.00),
('242-0015','CSE403','Microprocessor & Interface',4,79,'A',3.75),
('242-0015','CSE404','Microprocessor & Interface Lab',4,75,'A',3.75),
('242-0015','CSE405','Competitive Programming',4,70,'A-',3.50),

('242-0016','CSE401','Database Management System',4,69,'B+',3.25),
('242-0016','CSE402','Database Management System Lab',4,66,'B+',3.25),
('242-0016','CSE403','Microprocessor & Interface',4,62,'B',3.00),
('242-0016','CSE404','Microprocessor & Interface Lab',4,58,'B-',2.75),
('242-0016','CSE405','Competitive Programming',4,55,'B-',2.75),

('242-0017','CSE401','Database Management System',4,82,'A+',4.00),
('242-0017','CSE402','Database Management System Lab',4,78,'A',3.75),
('242-0017','CSE403','Microprocessor & Interface',4,74,'A-',3.50),
('242-0017','CSE404','Microprocessor & Interface Lab',4,70,'A-',3.50),
('242-0017','CSE405','Competitive Programming',4,66,'B+',3.25),

('242-0018','CSE401','Database Management System',4,76,'A',3.75),
('242-0018','CSE402','Database Management System Lab',4,73,'A-',3.50),
('242-0018','CSE403','Microprocessor & Interface',4,69,'B+',3.25),
('242-0018','CSE404','Microprocessor & Interface Lab',4,65,'B+',3.25),
('242-0018','CSE405','Competitive Programming',4,61,'B',3.00),

('242-0019','CSE401','Database Management System',4,89,'A+',4.00),
('242-0019','CSE402','Database Management System Lab',4,84,'A+',4.00),
('242-0019','CSE403','Microprocessor & Interface',4,80,'A+',4.00),
('242-0019','CSE404','Microprocessor & Interface Lab',4,76,'A',3.75),
('242-0019','CSE405','Competitive Programming',4,72,'A-',3.50),

('242-0020','CSE401','Database Management System',4,72,'A-',3.50),
('242-0020','CSE402','Database Management System Lab',4,69,'B+',3.25),
('242-0020','CSE403','Microprocessor & Interface',4,65,'B+',3.25),
('242-0020','CSE404','Microprocessor & Interface Lab',4,61,'B',3.00),
('242-0020','CSE405','Competitive Programming',4,57,'B-',2.75),

('242-0021','CSE401','Database Management System',4,85,'A+',4.00),
('242-0021','CSE402','Database Management System Lab',4,81,'A+',4.00),
('242-0021','CSE403','Microprocessor & Interface',4,77,'A',3.75),
('242-0021','CSE404','Microprocessor & Interface Lab',4,73,'A-',3.50),
('242-0021','CSE405','Competitive Programming',4,69,'B+',3.25),

('242-0022','CSE401','Database Management System',4,74,'A-',3.50),
('242-0022','CSE402','Database Management System Lab',4,71,'A-',3.50),
('242-0022','CSE403','Microprocessor & Interface',4,68,'B+',3.25),
('242-0022','CSE404','Microprocessor & Interface Lab',4,64,'B',3.00),
('242-0022','CSE405','Competitive Programming',4,60,'B',3.00),

('242-0023','CSE401','Database Management System',4,92,'A+',4.00),
('242-0023','CSE402','Database Management System Lab',4,88,'A+',4.00),
('242-0023','CSE403','Microprocessor & Interface',4,84,'A+',4.00),
('242-0023','CSE404','Microprocessor & Interface Lab',4,79,'A',3.75),
('242-0023','CSE405','Competitive Programming',4,75,'A',3.75),

('242-0024','CSE401','Database Management System',4,79,'A',3.75),
('242-0024','CSE402','Database Management System Lab',4,75,'A',3.75),
('242-0024','CSE403','Microprocessor & Interface',4,72,'A-',3.50),
('242-0024','CSE404','Microprocessor & Interface Lab',4,69,'B+',3.25),
('242-0024','CSE405','Competitive Programming',4,65,'B+',3.25),

('242-0025','CSE401','Database Management System',4,87,'A+',4.00),
('242-0025','CSE402','Database Management System Lab',4,83,'A+',4.00),
('242-0025','CSE403','Microprocessor & Interface',4,78,'A',3.75),
('242-0025','CSE404','Microprocessor & Interface Lab',4,74,'A-',3.50),
('242-0025','CSE405','Competitive Programming',4,71,'A-',3.50),

('242-0026','CSE401','Database Management System',4,68,'B+',3.25),
('242-0026','CSE402','Database Management System Lab',4,65,'B+',3.25),
('242-0026','CSE403','Microprocessor & Interface',4,61,'B',3.00),
('242-0026','CSE404','Microprocessor & Interface Lab',4,58,'B-',2.75),
('242-0026','CSE405','Competitive Programming',4,55,'B-',2.75),

('242-0027','CSE401','Database Management System',4,83,'A+',4.00),
('242-0027','CSE402','Database Management System Lab',4,79,'A',3.75),
('242-0027','CSE403','Microprocessor & Interface',4,75,'A',3.75),
('242-0027','CSE404','Microprocessor & Interface Lab',4,71,'A-',3.50),
('242-0027','CSE405','Competitive Programming',4,67,'B+',3.25),

('242-0028','CSE401','Database Management System',4,77,'A',3.75),
('242-0028','CSE402','Database Management System Lab',4,73,'A-',3.50),
('242-0028','CSE403','Microprocessor & Interface',4,69,'B+',3.25),
('242-0028','CSE404','Microprocessor & Interface Lab',4,66,'B+',3.25),
('242-0028','CSE405','Competitive Programming',4,62,'B',3.00),

('242-0029','CSE401','Database Management System',4,90,'A+',4.00),
('242-0029','CSE402','Database Management System Lab',4,86,'A+',4.00),
('242-0029','CSE403','Microprocessor & Interface',4,81,'A+',4.00),
('242-0029','CSE404','Microprocessor & Interface Lab',4,77,'A',3.75),
('242-0029','CSE405','Competitive Programming',4,73,'A-',3.50),

('242-0030','CSE401','Database Management System',4,73,'A-',3.50),
('242-0030','CSE402','Database Management System Lab',4,70,'A-',3.50),
('242-0030','CSE403','Microprocessor & Interface',4,66,'B+',3.25),
('242-0030','CSE404','Microprocessor & Interface Lab',4,62,'B',3.00),
('242-0030','CSE405','Competitive Programming',4,58,'B-',2.75),

('242-0031','CSE401','Database Management System',4,86,'A+',4.00),
('242-0031','CSE402','Database Management System Lab',4,82,'A+',4.00),
('242-0031','CSE403','Microprocessor & Interface',4,78,'A',3.75),
('242-0031','CSE404','Microprocessor & Interface Lab',4,74,'A-',3.50),
('242-0031','CSE405','Competitive Programming',4,70,'A-',3.50),

('242-0032','CSE401','Database Management System',4,75,'A',3.75),
('242-0032','CSE402','Database Management System Lab',4,72,'A-',3.50),
('242-0032','CSE403','Microprocessor & Interface',4,68,'B+',3.25),
('242-0032','CSE404','Microprocessor & Interface Lab',4,65,'B+',3.25),
('242-0032','CSE405','Competitive Programming',4,61,'B',3.00),

('242-0033','CSE401','Database Management System',4,93,'A+',4.00),
('242-0033','CSE402','Database Management System Lab',4,89,'A+',4.00),
('242-0033','CSE403','Microprocessor & Interface',4,84,'A+',4.00),
('242-0033','CSE404','Microprocessor & Interface Lab',4,80,'A+',4.00),
('242-0033','CSE405','Competitive Programming',4,76,'A',3.75),

('242-0034','CSE401','Database Management System',4,80,'A+',4.00),
('242-0034','CSE402','Database Management System Lab',4,76,'A',3.75),
('242-0034','CSE403','Microprocessor & Interface',4,73,'A-',3.50),
('242-0034','CSE404','Microprocessor & Interface Lab',4,69,'B+',3.25),
('242-0034','CSE405','Competitive Programming',4,66,'B+',3.25),

('242-0035','CSE401','Database Management System',4,88,'A+',4.00),
('242-0035','CSE402','Database Management System Lab',4,84,'A+',4.00),
('242-0035','CSE403','Microprocessor & Interface',4,79,'A',3.75),
('242-0035','CSE404','Microprocessor & Interface Lab',4,75,'A',3.75),
('242-0035','CSE405','Competitive Programming',4,71,'A-',3.50),

('242-0036','CSE401','Database Management System',4,67,'B+',3.25),
('242-0036','CSE402','Database Management System Lab',4,64,'B',3.00),
('242-0036','CSE403','Microprocessor & Interface',4,60,'B',3.00),
('242-0036','CSE404','Microprocessor & Interface Lab',4,57,'B-',2.75),
('242-0036','CSE405','Competitive Programming',4,54,'C+',2.50),

('242-0037','CSE401','Database Management System',4,84,'A+',4.00),
('242-0037','CSE402','Database Management System Lab',4,80,'A+',4.00),
('242-0037','CSE403','Microprocessor & Interface',4,75,'A',3.75),
('242-0037','CSE404','Microprocessor & Interface Lab',4,72,'A-',3.50),
('242-0037','CSE405','Competitive Programming',4,68,'B+',3.25),

('242-0038','CSE401','Database Management System',4,78,'A',3.75),
('242-0038','CSE402','Database Management System Lab',4,74,'A-',3.50),
('242-0038','CSE403','Microprocessor & Interface',4,70,'A-',3.50),
('242-0038','CSE404','Microprocessor & Interface Lab',4,67,'B+',3.25),
('242-0038','CSE405','Competitive Programming',4,63,'B',3.00),

('242-0039','CSE401','Database Management System',4,91,'A+',4.00),
('242-0039','CSE402','Database Management System Lab',4,87,'A+',4.00),
('242-0039','CSE403','Microprocessor & Interface',4,82,'A+',4.00),
('242-0039','CSE404','Microprocessor & Interface Lab',4,78,'A',3.75),
('242-0039','CSE405','Competitive Programming',4,74,'A-',3.50),

('242-0040','CSE401','Database Management System',4,72,'A-',3.50),
('242-0040','CSE402','Database Management System Lab',4,68,'B+',3.25),
('242-0040','CSE403','Microprocessor & Interface',4,65,'B+',3.25),
('242-0040','CSE404','Microprocessor & Interface Lab',4,61,'B',3.00),
('242-0040','CSE405','Competitive Programming',4,58,'B-',2.75),


('242-0041','CSE401','Database Management System',4,87,'A+',4.00),
('242-0041','CSE402','Database Management System Lab',4,83,'A+',4.00),
('242-0041','CSE403','Microprocessor & Interface',4,79,'A',3.75),
('242-0041','CSE404','Microprocessor & Interface Lab',4,75,'A',3.75),
('242-0041','CSE405','Competitive Programming',4,71,'A-',3.50),

('242-0042','CSE401','Database Management System',4,74,'A-',3.50),
('242-0042','CSE402','Database Management System Lab',4,70,'A-',3.50),
('242-0042','CSE403','Microprocessor & Interface',4,67,'B+',3.25),
('242-0042','CSE404','Microprocessor & Interface Lab',4,63,'B',3.00),
('242-0042','CSE405','Competitive Programming',4,60,'B',3.00),

('242-0043','CSE401','Database Management System',4,92,'A+',4.00),
('242-0043','CSE402','Database Management System Lab',4,88,'A+',4.00),
('242-0043','CSE403','Microprocessor & Interface',4,84,'A+',4.00),
('242-0043','CSE404','Microprocessor & Interface Lab',4,80,'A+',4.00),
('242-0043','CSE405','Competitive Programming',4,76,'A',3.75),

('242-0044','CSE401','Database Management System',4,79,'A',3.75),
('242-0044','CSE402','Database Management System Lab',4,75,'A',3.75),
('242-0044','CSE403','Microprocessor & Interface',4,72,'A-',3.50),
('242-0044','CSE404','Microprocessor & Interface Lab',4,68,'B+',3.25),
('242-0044','CSE405','Competitive Programming',4,65,'B+',3.25),

('242-0045','CSE401','Database Management System',4,89,'A+',4.00),
('242-0045','CSE402','Database Management System Lab',4,85,'A+',4.00),
('242-0045','CSE403','Microprocessor & Interface',4,80,'A+',4.00),
('242-0045','CSE404','Microprocessor & Interface Lab',4,76,'A',3.75),
('242-0045','CSE405','Competitive Programming',4,72,'A-',3.50),

('242-0046','CSE401','Database Management System',4,68,'B+',3.25),
('242-0046','CSE402','Database Management System Lab',4,64,'B',3.00),
('242-0046','CSE403','Microprocessor & Interface',4,60,'B',3.00),
('242-0046','CSE404','Microprocessor & Interface Lab',4,56,'B-',2.75),
('242-0046','CSE405','Competitive Programming',4,53,'C+',2.50),

('242-0047','CSE401','Database Management System',4,84,'A+',4.00),
('242-0047','CSE402','Database Management System Lab',4,80,'A+',4.00),
('242-0047','CSE403','Microprocessor & Interface',4,76,'A',3.75),
('242-0047','CSE404','Microprocessor & Interface Lab',4,72,'A-',3.50),
('242-0047','CSE405','Competitive Programming',4,69,'B+',3.25),

('242-0048','CSE401','Database Management System',4,77,'A',3.75),
('242-0048','CSE402','Database Management System Lab',4,73,'A-',3.50),
('242-0048','CSE403','Microprocessor & Interface',4,69,'B+',3.25),
('242-0048','CSE404','Microprocessor & Interface Lab',4,66,'B+',3.25),
('242-0048','CSE405','Competitive Programming',4,62,'B',3.00),

('242-0049','CSE401','Database Management System',4,90,'A+',4.00),
('242-0049','CSE402','Database Management System Lab',4,86,'A+',4.00),
('242-0049','CSE403','Microprocessor & Interface',4,82,'A+',4.00),
('242-0049','CSE404','Microprocessor & Interface Lab',4,78,'A',3.75),
('242-0049','CSE405','Competitive Programming',4,74,'A-',3.50),

('242-0050','CSE401','Database Management System',4,73,'A-',3.50),
('242-0050','CSE402','Database Management System Lab',4,69,'B+',3.25),
('242-0050','CSE403','Microprocessor & Interface',4,65,'B+',3.25),
('242-0050','CSE404','Microprocessor & Interface Lab',4,61,'B',3.00),
('242-0050','CSE405','Competitive Programming',4,57,'B-',2.75);




INSERT INTO result
(student_id, course_code, course_name, semester_id, marks, grade, grade_point)
VALUES

('243-0001','CSE301','Algorithm',3,86,'A+',4.00),
('243-0001','CSE302','Algorithm Lab',3,82,'A+',4.00),
('243-0001','STA301','Basic Statistics & Probability',3,78,'A',3.75),
('243-0001','CSE101','Structured Programming',3,74,'A-',3.50),
('243-0001','CSE102','Structured Programming Lab',3,70,'A-',3.50),

('243-0002','CSE301','Algorithm',3,75,'A',3.75),
('243-0002','CSE302','Algorithm Lab',3,72,'A-',3.50),
('243-0002','STA301','Basic Statistics & Probability',3,68,'B+',3.25),
('243-0002','CSE101','Structured Programming',3,65,'B+',3.25),
('243-0002','CSE102','Structured Programming Lab',3,61,'B',3.00),

('243-0003','CSE301','Algorithm',3,92,'A+',4.00),
('243-0003','CSE302','Algorithm Lab',3,88,'A+',4.00),
('243-0003','STA301','Basic Statistics & Probability',3,84,'A+',4.00),
('243-0003','CSE101','Structured Programming',3,80,'A+',4.00),
('243-0003','CSE102','Structured Programming Lab',3,76,'A',3.75),

('243-0004','CSE301','Algorithm',3,79,'A',3.75),
('243-0004','CSE302','Algorithm Lab',3,75,'A',3.75),
('243-0004','STA301','Basic Statistics & Probability',3,72,'A-',3.50),
('243-0004','CSE101','Structured Programming',3,68,'B+',3.25),
('243-0004','CSE102','Structured Programming Lab',3,65,'B+',3.25),

('243-0005','CSE301','Algorithm',3,88,'A+',4.00),
('243-0005','CSE302','Algorithm Lab',3,84,'A+',4.00),
('243-0005','STA301','Basic Statistics & Probability',3,80,'A+',4.00),
('243-0005','CSE101','Structured Programming',3,76,'A',3.75),
('243-0005','CSE102','Structured Programming Lab',3,72,'A-',3.50),

('243-0006','CSE301','Algorithm',3,68,'B+',3.25),
('243-0006','CSE302','Algorithm Lab',3,65,'B+',3.25),
('243-0006','STA301','Basic Statistics & Probability',3,61,'B',3.00),
('243-0006','CSE101','Structured Programming',3,58,'B-',2.75),
('243-0006','CSE102','Structured Programming Lab',3,55,'B-',2.75),

('243-0007','CSE301','Algorithm',3,83,'A+',4.00),
('243-0007','CSE302','Algorithm Lab',3,79,'A',3.75),
('243-0007','STA301','Basic Statistics & Probability',3,75,'A',3.75),
('243-0007','CSE101','Structured Programming',3,71,'A-',3.50),
('243-0007','CSE102','Structured Programming Lab',3,67,'B+',3.25),

('243-0008','CSE301','Algorithm',3,77,'A',3.75),
('243-0008','CSE302','Algorithm Lab',3,73,'A-',3.50),
('243-0008','STA301','Basic Statistics & Probability',3,69,'B+',3.25),
('243-0008','CSE101','Structured Programming',3,66,'B+',3.25),
('243-0008','CSE102','Structured Programming Lab',3,62,'B',3.00),

('243-0009','CSE301','Algorithm',3,90,'A+',4.00),
('243-0009','CSE302','Algorithm Lab',3,86,'A+',4.00),
('243-0009','STA301','Basic Statistics & Probability',3,82,'A+',4.00),
('243-0009','CSE101','Structured Programming',3,78,'A',3.75),
('243-0009','CSE102','Structured Programming Lab',3,74,'A-',3.50),

('243-0010','CSE301','Algorithm',3,73,'A-',3.50),
('243-0010','CSE302','Algorithm Lab',3,70,'A-',3.50),
('243-0010','STA301','Basic Statistics & Probability',3,66,'B+',3.25),
('243-0010','CSE101','Structured Programming',3,62,'B',3.00),
('243-0010','CSE102','Structured Programming Lab',3,58,'B-',2.75),

('243-0011','CSE301','Algorithm',3,85,'A+',4.00),
('243-0011','CSE302','Algorithm Lab',3,81,'A+',4.00),
('243-0011','STA301','Basic Statistics & Probability',3,77,'A',3.75),
('243-0011','CSE101','Structured Programming',3,73,'A-',3.50),
('243-0011','CSE102','Structured Programming Lab',3,69,'B+',3.25),

('243-0012','CSE301','Algorithm',3,74,'A-',3.50),
('243-0012','CSE302','Algorithm Lab',3,71,'A-',3.50),
('243-0012','STA301','Basic Statistics & Probability',3,68,'B+',3.25),
('243-0012','CSE101','Structured Programming',3,64,'B',3.00),
('243-0012','CSE102','Structured Programming Lab',3,60,'B',3.00),

('243-0013','CSE301','Algorithm',3,93,'A+',4.00),
('243-0013','CSE302','Algorithm Lab',3,89,'A+',4.00),
('243-0013','STA301','Basic Statistics & Probability',3,85,'A+',4.00),
('243-0013','CSE101','Structured Programming',3,80,'A+',4.00),
('243-0013','CSE102','Structured Programming Lab',3,76,'A',3.75),

('243-0014','CSE301','Algorithm',3,80,'A+',4.00),
('243-0014','CSE302','Algorithm Lab',3,76,'A',3.75),
('243-0014','STA301','Basic Statistics & Probability',3,73,'A-',3.50),
('243-0014','CSE101','Structured Programming',3,69,'B+',3.25),
('243-0014','CSE102','Structured Programming Lab',3,66,'B+',3.25),

('243-0015','CSE301','Algorithm',3,89,'A+',4.00),
('243-0015','CSE302','Algorithm Lab',3,85,'A+',4.00),
('243-0015','STA301','Basic Statistics & Probability',3,81,'A+',4.00),
('243-0015','CSE101','Structured Programming',3,77,'A',3.75),
('243-0015','CSE102','Structured Programming Lab',3,73,'A-',3.50),

('243-0016','CSE301','Algorithm',3,69,'B+',3.25),
('243-0016','CSE302','Algorithm Lab',3,66,'B+',3.25),
('243-0016','STA301','Basic Statistics & Probability',3,62,'B',3.00),
('243-0016','CSE101','Structured Programming',3,59,'B-',2.75),
('243-0016','CSE102','Structured Programming Lab',3,56,'B-',2.75),

('243-0017','CSE301','Algorithm',3,84,'A+',4.00),
('243-0017','CSE302','Algorithm Lab',3,80,'A+',4.00),
('243-0017','STA301','Basic Statistics & Probability',3,76,'A',3.75),
('243-0017','CSE101','Structured Programming',3,72,'A-',3.50),
('243-0017','CSE102','Structured Programming Lab',3,68,'B+',3.25),

('243-0018','CSE301','Algorithm',3,78,'A',3.75),
('243-0018','CSE302','Algorithm Lab',3,74,'A-',3.50),
('243-0018','STA301','Basic Statistics & Probability',3,70,'A-',3.50),
('243-0018','CSE101','Structured Programming',3,67,'B+',3.25),
('243-0018','CSE102','Structured Programming Lab',3,63,'B',3.00),

('243-0019','CSE301','Algorithm',3,91,'A+',4.00),
('243-0019','CSE302','Algorithm Lab',3,87,'A+',4.00),
('243-0019','STA301','Basic Statistics & Probability',3,83,'A+',4.00),
('243-0019','CSE101','Structured Programming',3,79,'A',3.75),
('243-0019','CSE102','Structured Programming Lab',3,75,'A',3.75),

('243-0020','CSE301','Algorithm',3,74,'A-',3.50),
('243-0020','CSE302','Algorithm Lab',3,70,'A-',3.50),
('243-0020','STA301','Basic Statistics & Probability',3,67,'B+',3.25),
('243-0020','CSE101','Structured Programming',3,63,'B',3.00),
('243-0020','CSE102','Structured Programming Lab',3,59,'B-',2.75),

('243-0021','CSE301','Algorithm',3,86,'A+',4.00),
('243-0021','CSE302','Algorithm Lab',3,82,'A+',4.00),
('243-0021','STA301','Basic Statistics & Probability',3,78,'A',3.75),
('243-0021','CSE101','Structured Programming',3,74,'A-',3.50),
('243-0021','CSE102','Structured Programming Lab',3,70,'A-',3.50),

('243-0022','CSE301','Algorithm',3,75,'A',3.75),
('243-0022','CSE302','Algorithm Lab',3,72,'A-',3.50),
('243-0022','STA301','Basic Statistics & Probability',3,69,'B+',3.25),
('243-0022','CSE101','Structured Programming',3,65,'B+',3.25),
('243-0022','CSE102','Structured Programming Lab',3,61,'B',3.00),

('243-0023','CSE301','Algorithm',3,94,'A+',4.00),
('243-0023','CSE302','Algorithm Lab',3,90,'A+',4.00),
('243-0023','STA301','Basic Statistics & Probability',3,85,'A+',4.00),
('243-0023','CSE101','Structured Programming',3,81,'A+',4.00),
('243-0023','CSE102','Structured Programming Lab',3,77,'A',3.75),

('243-0024','CSE301','Algorithm',3,81,'A+',4.00),
('243-0024','CSE302','Algorithm Lab',3,77,'A',3.75),
('243-0024','STA301','Basic Statistics & Probability',3,74,'A-',3.50),
('243-0024','CSE101','Structured Programming',3,70,'A-',3.50),
('243-0024','CSE102','Structured Programming Lab',3,66,'B+',3.25),

('243-0025','CSE301','Algorithm',3,90,'A+',4.00),
('243-0025','CSE302','Algorithm Lab',3,86,'A+',4.00),
('243-0025','STA301','Basic Statistics & Probability',3,82,'A+',4.00),
('243-0025','CSE101','Structured Programming',3,78,'A',3.75),
('243-0025','CSE102','Structured Programming Lab',3,74,'A-',3.50),

('243-0026','CSE301','Algorithm',3,70,'A-',3.50),
('243-0026','CSE302','Algorithm Lab',3,67,'B+',3.25),
('243-0026','STA301','Basic Statistics & Probability',3,63,'B',3.00),
('243-0026','CSE101','Structured Programming',3,60,'B',3.00),
('243-0026','CSE102','Structured Programming Lab',3,56,'B-',2.75),

('243-0027','CSE301','Algorithm',3,85,'A+',4.00),
('243-0027','CSE302','Algorithm Lab',3,81,'A+',4.00),
('243-0027','STA301','Basic Statistics & Probability',3,77,'A',3.75),
('243-0027','CSE101','Structured Programming',3,73,'A-',3.50),
('243-0027','CSE102','Structured Programming Lab',3,69,'B+',3.25),

('243-0028','CSE301','Algorithm',3,79,'A',3.75),
('243-0028','CSE302','Algorithm Lab',3,75,'A',3.75),
('243-0028','STA301','Basic Statistics & Probability',3,71,'A-',3.50),
('243-0028','CSE101','Structured Programming',3,67,'B+',3.25),
('243-0028','CSE102','Structured Programming Lab',3,63,'B',3.00),

('243-0029','CSE301','Algorithm',3,92,'A+',4.00),
('243-0029','CSE302','Algorithm Lab',3,88,'A+',4.00),
('243-0029','STA301','Basic Statistics & Probability',3,84,'A+',4.00),
('243-0029','CSE101','Structured Programming',3,79,'A',3.75),
('243-0029','CSE102','Structured Programming Lab',3,75,'A',3.75),

('243-0030','CSE301','Algorithm',3,75,'A',3.75),
('243-0030','CSE302','Algorithm Lab',3,71,'A-',3.50),
('243-0030','STA301','Basic Statistics & Probability',3,68,'B+',3.25),
('243-0030','CSE101','Structured Programming',3,64,'B',3.00),
('243-0030','CSE102','Structured Programming Lab',3,60,'B',3.00),

('243-0031','CSE301','Algorithm',3,87,'A+',4.00),
('243-0031','CSE302','Algorithm Lab',3,83,'A+',4.00),
('243-0031','STA301','Basic Statistics & Probability',3,79,'A',3.75),
('243-0031','CSE101','Structured Programming',3,75,'A',3.75),
('243-0031','CSE102','Structured Programming Lab',3,71,'A-',3.50),

('243-0032','CSE301','Algorithm',3,76,'A',3.75),
('243-0032','CSE302','Algorithm Lab',3,73,'A-',3.50),
('243-0032','STA301','Basic Statistics & Probability',3,70,'A-',3.50),
('243-0032','CSE101','Structured Programming',3,66,'B+',3.25),
('243-0032','CSE102','Structured Programming Lab',3,62,'B',3.00),

('243-0033','CSE301','Algorithm',3,95,'A+',4.00),
('243-0033','CSE302','Algorithm Lab',3,91,'A+',4.00),
('243-0033','STA301','Basic Statistics & Probability',3,86,'A+',4.00),
('243-0033','CSE101','Structured Programming',3,82,'A+',4.00),
('243-0033','CSE102','Structured Programming Lab',3,78,'A',3.75),

('243-0034','CSE301','Algorithm',3,82,'A+',4.00),
('243-0034','CSE302','Algorithm Lab',3,78,'A',3.75),
('243-0034','STA301','Basic Statistics & Probability',3,75,'A',3.75),
('243-0034','CSE101','Structured Programming',3,71,'A-',3.50),
('243-0034','CSE102','Structured Programming Lab',3,67,'B+',3.25),

('243-0035','CSE301','Algorithm',3,91,'A+',4.00),
('243-0035','CSE302','Algorithm Lab',3,87,'A+',4.00),
('243-0035','STA301','Basic Statistics & Probability',3,83,'A+',4.00),
('243-0035','CSE101','Structured Programming',3,79,'A',3.75),
('243-0035','CSE102','Structured Programming Lab',3,75,'A',3.75),

('243-0036','CSE301','Algorithm',3,71,'A-',3.50),
('243-0036','CSE302','Algorithm Lab',3,68,'B+',3.25),
('243-0036','STA301','Basic Statistics & Probability',3,64,'B',3.00),
('243-0036','CSE101','Structured Programming',3,60,'B',3.00),
('243-0036','CSE102','Structured Programming Lab',3,57,'B-',2.75),

('243-0037','CSE301','Algorithm',3,86,'A+',4.00),
('243-0037','CSE302','Algorithm Lab',3,82,'A+',4.00),
('243-0037','STA301','Basic Statistics & Probability',3,78,'A',3.75),
('243-0037','CSE101','Structured Programming',3,74,'A-',3.50),
('243-0037','CSE102','Structured Programming Lab',3,70,'A-',3.50),

('243-0038','CSE301','Algorithm',3,80,'A+',4.00),
('243-0038','CSE302','Algorithm Lab',3,76,'A',3.75),
('243-0038','STA301','Basic Statistics & Probability',3,72,'A-',3.50),
('243-0038','CSE101','Structured Programming',3,69,'B+',3.25),
('243-0038','CSE102','Structured Programming Lab',3,65,'B+',3.25),

('243-0039','CSE301','Algorithm',3,93,'A+',4.00),
('243-0039','CSE302','Algorithm Lab',3,89,'A+',4.00),
('243-0039','STA301','Basic Statistics & Probability',3,85,'A+',4.00),
('243-0039','CSE101','Structured Programming',3,80,'A+',4.00),
('243-0039','CSE102','Structured Programming Lab',3,76,'A',3.75),

('243-0040','CSE301','Algorithm',3,76,'A',3.75),
('243-0040','CSE302','Algorithm Lab',3,72,'A-',3.50),
('243-0040','STA301','Basic Statistics & Probability',3,69,'B+',3.25),
('243-0040','CSE101','Structured Programming',3,65,'B+',3.25),
('243-0040','CSE102','Structured Programming Lab',3,61,'B',3.00),

('243-0041','CSE301','Algorithm',3,88,'A+',4.00),
('243-0041','CSE302','Algorithm Lab',3,84,'A+',4.00),
('243-0041','STA301','Basic Statistics & Probability',3,80,'A+',4.00),
('243-0041','CSE101','Structured Programming',3,76,'A',3.75),
('243-0041','CSE102','Structured Programming Lab',3,72,'A-',3.50),

('243-0042','CSE301','Algorithm',3,77,'A',3.75),
('243-0042','CSE302','Algorithm Lab',3,74,'A-',3.50),
('243-0042','STA301','Basic Statistics & Probability',3,70,'A-',3.50),
('243-0042','CSE101','Structured Programming',3,67,'B+',3.25),
('243-0042','CSE102','Structured Programming Lab',3,63,'B',3.00),

('243-0043','CSE301','Algorithm',3,96,'A+',4.00),
('243-0043','CSE302','Algorithm Lab',3,92,'A+',4.00),
('243-0043','STA301','Basic Statistics & Probability',3,87,'A+',4.00),
('243-0043','CSE101','Structured Programming',3,83,'A+',4.00),
('243-0043','CSE102','Structured Programming Lab',3,79,'A',3.75),

('243-0044','CSE301','Algorithm',3,83,'A+',4.00),
('243-0044','CSE302','Algorithm Lab',3,79,'A',3.75),
('243-0044','STA301','Basic Statistics & Probability',3,76,'A',3.75),
('243-0044','CSE101','Structured Programming',3,72,'A-',3.50),
('243-0044','CSE102','Structured Programming Lab',3,68,'B+',3.25),

('243-0045','CSE301','Algorithm',3,92,'A+',4.00),
('243-0045','CSE302','Algorithm Lab',3,88,'A+',4.00),
('243-0045','STA301','Basic Statistics & Probability',3,84,'A+',4.00),
('243-0045','CSE101','Structured Programming',3,80,'A+',4.00),
('243-0045','CSE102','Structured Programming Lab',3,76,'A',3.75),

('243-0046','CSE301','Algorithm',3,72,'A-',3.50),
('243-0046','CSE302','Algorithm Lab',3,69,'B+',3.25),
('243-0046','STA301','Basic Statistics & Probability',3,65,'B+',3.25),
('243-0046','CSE101','Structured Programming',3,61,'B',3.00),
('243-0046','CSE102','Structured Programming Lab',3,58,'B-',2.75),

('243-0047','CSE301','Algorithm',3,87,'A+',4.00),
('243-0047','CSE302','Algorithm Lab',3,83,'A+',4.00),
('243-0047','STA301','Basic Statistics & Probability',3,79,'A',3.75),
('243-0047','CSE101','Structured Programming',3,75,'A',3.75),
('243-0047','CSE102','Structured Programming Lab',3,71,'A-',3.50),

('243-0048','CSE301','Algorithm',3,81,'A+',4.00),
('243-0048','CSE302','Algorithm Lab',3,77,'A',3.75),
('243-0048','STA301','Basic Statistics & Probability',3,73,'A-',3.50),
('243-0048','CSE101','Structured Programming',3,69,'B+',3.25),
('243-0048','CSE102','Structured Programming Lab',3,66,'B+',3.25),

('243-0049','CSE301','Algorithm',3,94,'A+',4.00),
('243-0049','CSE302','Algorithm Lab',3,90,'A+',4.00),
('243-0049','STA301','Basic Statistics & Probability',3,86,'A+',4.00),
('243-0049','CSE101','Structured Programming',3,81,'A+',4.00),
('243-0049','CSE102','Structured Programming Lab',3,77,'A',3.75),

('243-0050','CSE301','Algorithm',3,77,'A',3.75),
('243-0050','CSE302','Algorithm Lab',3,73,'A-',3.50),
('243-0050','STA301','Basic Statistics & Probability',3,70,'A-',3.50),
('243-0050','CSE101','Structured Programming',3,66,'B+',3.25),
('243-0050','CSE102','Structured Programming Lab',3,62,'B',3.00);



INSERT INTO result
(student_id, course_code, course_name, semester_id, marks, grade, grade_point)
VALUES

('244-0001','CSE201','Data Structure',2,84,'A+',4.00),
('244-0001','CSE202','Data Structure Lab',2,80,'A+',4.00),
('244-0001','ENG201','English 2',2,76,'A',3.75),
('244-0001','PHY201','Physics 2',2,72,'A-',3.50),
('244-0001','MTH201','Differential Equation & Laplace Transform',2,68,'B+',3.25),

('244-0002','CSE201','Data Structure',2,73,'A-',3.50),
('244-0002','CSE202','Data Structure Lab',2,70,'A-',3.50),
('244-0002','ENG201','English 2',2,67,'B+',3.25),
('244-0002','PHY201','Physics 2',2,63,'B',3.00),
('244-0002','MTH201','Differential Equation & Laplace Transform',2,60,'B',3.00),

('244-0003','CSE201','Data Structure',2,91,'A+',4.00),
('244-0003','CSE202','Data Structure Lab',2,86,'A+',4.00),
('244-0003','ENG201','English 2',2,82,'A+',4.00),
('244-0003','PHY201','Physics 2',2,78,'A',3.75),
('244-0003','MTH201','Differential Equation & Laplace Transform',2,74,'A-',3.50),

('244-0004','CSE201','Data Structure',2,78,'A',3.75),
('244-0004','CSE202','Data Structure Lab',2,74,'A-',3.50),
('244-0004','ENG201','English 2',2,71,'A-',3.50),
('244-0004','PHY201','Physics 2',2,68,'B+',3.25),
('244-0004','MTH201','Differential Equation & Laplace Transform',2,65,'B+',3.25),

('244-0005','CSE201','Data Structure',2,87,'A+',4.00),
('244-0005','CSE202','Data Structure Lab',2,83,'A+',4.00),
('244-0005','ENG201','English 2',2,79,'A',3.75),
('244-0005','PHY201','Physics 2',2,75,'A',3.75),
('244-0005','MTH201','Differential Equation & Laplace Transform',2,70,'A-',3.50),

('244-0006','CSE201','Data Structure',2,69,'B+',3.25),
('244-0006','CSE202','Data Structure Lab',2,66,'B+',3.25),
('244-0006','ENG201','English 2',2,62,'B',3.00),
('244-0006','PHY201','Physics 2',2,58,'B-',2.75),
('244-0006','MTH201','Differential Equation & Laplace Transform',2,55,'B-',2.75),

('244-0007','CSE201','Data Structure',2,82,'A+',4.00),
('244-0007','CSE202','Data Structure Lab',2,78,'A',3.75),
('244-0007','ENG201','English 2',2,74,'A-',3.50),
('244-0007','PHY201','Physics 2',2,70,'A-',3.50),
('244-0007','MTH201','Differential Equation & Laplace Transform',2,66,'B+',3.25),

('244-0008','CSE201','Data Structure',2,76,'A',3.75),
('244-0008','CSE202','Data Structure Lab',2,73,'A-',3.50),
('244-0008','ENG201','English 2',2,69,'B+',3.25),
('244-0008','PHY201','Physics 2',2,65,'B+',3.25),
('244-0008','MTH201','Differential Equation & Laplace Transform',2,61,'B',3.00),

('244-0009','CSE201','Data Structure',2,89,'A+',4.00),
('244-0009','CSE202','Data Structure Lab',2,84,'A+',4.00),
('244-0009','ENG201','English 2',2,80,'A+',4.00),
('244-0009','PHY201','Physics 2',2,76,'A',3.75),
('244-0009','MTH201','Differential Equation & Laplace Transform',2,72,'A-',3.50),

('244-0010','CSE201','Data Structure',2,72,'A-',3.50),
('244-0010','CSE202','Data Structure Lab',2,69,'B+',3.25),
('244-0010','ENG201','English 2',2,65,'B+',3.25),
('244-0010','PHY201','Physics 2',2,61,'B',3.00),
('244-0010','MTH201','Differential Equation & Laplace Transform',2,57,'B-',2.75),


('244-0011','CSE201','Data Structure',2,85,'A+',4.00),
('244-0011','CSE202','Data Structure Lab',2,81,'A+',4.00),
('244-0011','ENG201','English 2',2,77,'A',3.75),
('244-0011','PHY201','Physics 2',2,73,'A-',3.50),
('244-0011','MTH201','Differential Equation & Laplace Transform',2,69,'B+',3.25),

('244-0012','CSE201','Data Structure',2,74,'A-',3.50),
('244-0012','CSE202','Data Structure Lab',2,71,'A-',3.50),
('244-0012','ENG201','English 2',2,68,'B+',3.25),
('244-0012','PHY201','Physics 2',2,64,'B',3.00),
('244-0012','MTH201','Differential Equation & Laplace Transform',2,60,'B',3.00),

('244-0013','CSE201','Data Structure',2,92,'A+',4.00),
('244-0013','CSE202','Data Structure Lab',2,88,'A+',4.00),
('244-0013','ENG201','English 2',2,83,'A+',4.00),
('244-0013','PHY201','Physics 2',2,79,'A',3.75),
('244-0013','MTH201','Differential Equation & Laplace Transform',2,75,'A',3.75),

('244-0014','CSE201','Data Structure',2,79,'A',3.75),
('244-0014','CSE202','Data Structure Lab',2,75,'A',3.75),
('244-0014','ENG201','English 2',2,72,'A-',3.50),
('244-0014','PHY201','Physics 2',2,69,'B+',3.25),
('244-0014','MTH201','Differential Equation & Laplace Transform',2,66,'B+',3.25),

('244-0015','CSE201','Data Structure',2,88,'A+',4.00),
('244-0015','CSE202','Data Structure Lab',2,84,'A+',4.00),
('244-0015','ENG201','English 2',2,80,'A+',4.00),
('244-0015','PHY201','Physics 2',2,76,'A',3.75),
('244-0015','MTH201','Differential Equation & Laplace Transform',2,72,'A-',3.50),

('244-0016','CSE201','Data Structure',2,68,'B+',3.25),
('244-0016','CSE202','Data Structure Lab',2,65,'B+',3.25),
('244-0016','ENG201','English 2',2,61,'B',3.00),
('244-0016','PHY201','Physics 2',2,58,'B-',2.75),
('244-0016','MTH201','Differential Equation & Laplace Transform',2,55,'B-',2.75),

('244-0017','CSE201','Data Structure',2,83,'A+',4.00),
('244-0017','CSE202','Data Structure Lab',2,79,'A',3.75),
('244-0017','ENG201','English 2',2,75,'A',3.75),
('244-0017','PHY201','Physics 2',2,71,'A-',3.50),
('244-0017','MTH201','Differential Equation & Laplace Transform',2,67,'B+',3.25),

('244-0018','CSE201','Data Structure',2,77,'A',3.75),
('244-0018','CSE202','Data Structure Lab',2,73,'A-',3.50),
('244-0018','ENG201','English 2',2,69,'B+',3.25),
('244-0018','PHY201','Physics 2',2,66,'B+',3.25),
('244-0018','MTH201','Differential Equation & Laplace Transform',2,62,'B',3.00),

('244-0019','CSE201','Data Structure',2,90,'A+',4.00),
('244-0019','CSE202','Data Structure Lab',2,86,'A+',4.00),
('244-0019','ENG201','English 2',2,81,'A+',4.00),
('244-0019','PHY201','Physics 2',2,77,'A',3.75),
('244-0019','MTH201','Differential Equation & Laplace Transform',2,73,'A-',3.50),

('244-0020','CSE201','Data Structure',2,73,'A-',3.50),
('244-0020','CSE202','Data Structure Lab',2,70,'A-',3.50),
('244-0020','ENG201','English 2',2,66,'B+',3.25),
('244-0020','PHY201','Physics 2',2,62,'B',3.00),
('244-0020','MTH201','Differential Equation & Laplace Transform',2,58,'B-',2.75),


('244-0021','CSE201','Data Structure',2,86,'A+',4.00),
('244-0021','CSE202','Data Structure Lab',2,82,'A+',4.00),
('244-0021','ENG201','English 2',2,78,'A',3.75),
('244-0021','PHY201','Physics 2',2,74,'A-',3.50),
('244-0021','MTH201','Differential Equation & Laplace Transform',2,70,'A-',3.50),

('244-0022','CSE201','Data Structure',2,75,'A',3.75),
('244-0022','CSE202','Data Structure Lab',2,72,'A-',3.50),
('244-0022','ENG201','English 2',2,69,'B+',3.25),
('244-0022','PHY201','Physics 2',2,65,'B+',3.25),
('244-0022','MTH201','Differential Equation & Laplace Transform',2,61,'B',3.00),

('244-0023','CSE201','Data Structure',2,93,'A+',4.00),
('244-0023','CSE202','Data Structure Lab',2,89,'A+',4.00),
('244-0023','ENG201','English 2',2,85,'A+',4.00),
('244-0023','PHY201','Physics 2',2,80,'A+',4.00),
('244-0023','MTH201','Differential Equation & Laplace Transform',2,76,'A',3.75),

('244-0024','CSE201','Data Structure',2,80,'A+',4.00),
('244-0024','CSE202','Data Structure Lab',2,76,'A',3.75),
('244-0024','ENG201','English 2',2,73,'A-',3.50),
('244-0024','PHY201','Physics 2',2,70,'A-',3.50),
('244-0024','MTH201','Differential Equation & Laplace Transform',2,66,'B+',3.25),

('244-0025','CSE201','Data Structure',2,89,'A+',4.00),
('244-0025','CSE202','Data Structure Lab',2,85,'A+',4.00),
('244-0025','ENG201','English 2',2,81,'A+',4.00),
('244-0025','PHY201','Physics 2',2,77,'A',3.75),
('244-0025','MTH201','Differential Equation & Laplace Transform',2,73,'A-',3.50),

('244-0026','CSE201','Data Structure',2,69,'B+',3.25),
('244-0026','CSE202','Data Structure Lab',2,66,'B+',3.25),
('244-0026','ENG201','English 2',2,62,'B',3.00),
('244-0026','PHY201','Physics 2',2,59,'B-',2.75),
('244-0026','MTH201','Differential Equation & Laplace Transform',2,56,'B-',2.75),

('244-0027','CSE201','Data Structure',2,84,'A+',4.00),
('244-0027','CSE202','Data Structure Lab',2,80,'A+',4.00),
('244-0027','ENG201','English 2',2,76,'A',3.75),
('244-0027','PHY201','Physics 2',2,72,'A-',3.50),
('244-0027','MTH201','Differential Equation & Laplace Transform',2,68,'B+',3.25),

('244-0028','CSE201','Data Structure',2,78,'A',3.75),
('244-0028','CSE202','Data Structure Lab',2,74,'A-',3.50),
('244-0028','ENG201','English 2',2,70,'A-',3.50),
('244-0028','PHY201','Physics 2',2,67,'B+',3.25),
('244-0028','MTH201','Differential Equation & Laplace Transform',2,63,'B',3.00),

('244-0029','CSE201','Data Structure',2,91,'A+',4.00),
('244-0029','CSE202','Data Structure Lab',2,87,'A+',4.00),
('244-0029','ENG201','English 2',2,83,'A+',4.00),
('244-0029','PHY201','Physics 2',2,78,'A',3.75),
('244-0029','MTH201','Differential Equation & Laplace Transform',2,74,'A-',3.50),

('244-0030','CSE201','Data Structure',2,74,'A-',3.50),
('244-0030','CSE202','Data Structure Lab',2,71,'A-',3.50),
('244-0030','ENG201','English 2',2,67,'B+',3.25),
('244-0030','PHY201','Physics 2',2,63,'B',3.00),
('244-0030','MTH201','Differential Equation & Laplace Transform',2,59,'B-',2.75),

('244-0031','CSE201','Data Structure',2,87,'A+',4.00),
('244-0031','CSE202','Data Structure Lab',2,83,'A+',4.00),
('244-0031','ENG201','English 2',2,79,'A',3.75),
('244-0031','PHY201','Physics 2',2,75,'A',3.75),
('244-0031','MTH201','Differential Equation & Laplace Transform',2,71,'A-',3.50),

('244-0032','CSE201','Data Structure',2,76,'A',3.75),
('244-0032','CSE202','Data Structure Lab',2,73,'A-',3.50),
('244-0032','ENG201','English 2',2,70,'A-',3.50),
('244-0032','PHY201','Physics 2',2,66,'B+',3.25),
('244-0032','MTH201','Differential Equation & Laplace Transform',2,62,'B',3.00),

('244-0033','CSE201','Data Structure',2,94,'A+',4.00),
('244-0033','CSE202','Data Structure Lab',2,90,'A+',4.00),
('244-0033','ENG201','English 2',2,85,'A+',4.00),
('244-0033','PHY201','Physics 2',2,81,'A+',4.00),
('244-0033','MTH201','Differential Equation & Laplace Transform',2,77,'A',3.75),

('244-0034','CSE201','Data Structure',2,81,'A+',4.00),
('244-0034','CSE202','Data Structure Lab',2,77,'A',3.75),
('244-0034','ENG201','English 2',2,74,'A-',3.50),
('244-0034','PHY201','Physics 2',2,70,'A-',3.50),
('244-0034','MTH201','Differential Equation & Laplace Transform',2,67,'B+',3.25),

('244-0035','CSE201','Data Structure',2,90,'A+',4.00),
('244-0035','CSE202','Data Structure Lab',2,86,'A+',4.00),
('244-0035','ENG201','English 2',2,82,'A+',4.00),
('244-0035','PHY201','Physics 2',2,78,'A',3.75),
('244-0035','MTH201','Differential Equation & Laplace Transform',2,74,'A-',3.50),

('244-0036','CSE201','Data Structure',2,70,'A-',3.50),
('244-0036','CSE202','Data Structure Lab',2,67,'B+',3.25),
('244-0036','ENG201','English 2',2,63,'B',3.00),
('244-0036','PHY201','Physics 2',2,60,'B',3.00),
('244-0036','MTH201','Differential Equation & Laplace Transform',2,56,'B-',2.75),

('244-0037','CSE201','Data Structure',2,85,'A+',4.00),
('244-0037','CSE202','Data Structure Lab',2,81,'A+',4.00),
('244-0037','ENG201','English 2',2,77,'A',3.75),
('244-0037','PHY201','Physics 2',2,73,'A-',3.50),
('244-0037','MTH201','Differential Equation & Laplace Transform',2,69,'B+',3.25),

('244-0038','CSE201','Data Structure',2,79,'A',3.75),
('244-0038','CSE202','Data Structure Lab',2,75,'A',3.75),
('244-0038','ENG201','English 2',2,71,'A-',3.50),
('244-0038','PHY201','Physics 2',2,68,'B+',3.25),
('244-0038','MTH201','Differential Equation & Laplace Transform',2,64,'B',3.00),

('244-0039','CSE201','Data Structure',2,92,'A+',4.00),
('244-0039','CSE202','Data Structure Lab',2,88,'A+',4.00),
('244-0039','ENG201','English 2',2,84,'A+',4.00),
('244-0039','PHY201','Physics 2',2,79,'A',3.75),
('244-0039','MTH201','Differential Equation & Laplace Transform',2,75,'A',3.75),

('244-0040','CSE201','Data Structure',2,75,'A',3.75),
('244-0040','CSE202','Data Structure Lab',2,72,'A-',3.50),
('244-0040','ENG201','English 2',2,68,'B+',3.25),
('244-0040','PHY201','Physics 2',2,64,'B',3.00),
('244-0040','MTH201','Differential Equation & Laplace Transform',2,60,'B',3.00),


('244-0041','CSE201','Data Structure',2,88,'A+',4.00),
('244-0041','CSE202','Data Structure Lab',2,84,'A+',4.00),
('244-0041','ENG201','English 2',2,80,'A+',4.00),
('244-0041','PHY201','Physics 2',2,76,'A',3.75),
('244-0041','MTH201','Differential Equation & Laplace Transform',2,72,'A-',3.50),

('244-0042','CSE201','Data Structure',2,77,'A',3.75),
('244-0042','CSE202','Data Structure Lab',2,74,'A-',3.50),
('244-0042','ENG201','English 2',2,70,'A-',3.50),
('244-0042','PHY201','Physics 2',2,67,'B+',3.25),
('244-0042','MTH201','Differential Equation & Laplace Transform',2,63,'B',3.00),

('244-0043','CSE201','Data Structure',2,95,'A+',4.00),
('244-0043','CSE202','Data Structure Lab',2,91,'A+',4.00),
('244-0043','ENG201','English 2',2,86,'A+',4.00),
('244-0043','PHY201','Physics 2',2,82,'A+',4.00),
('244-0043','MTH201','Differential Equation & Laplace Transform',2,78,'A',3.75),

('244-0044','CSE201','Data Structure',2,82,'A+',4.00),
('244-0044','CSE202','Data Structure Lab',2,78,'A',3.75),
('244-0044','ENG201','English 2',2,75,'A',3.75),
('244-0044','PHY201','Physics 2',2,71,'A-',3.50),
('244-0044','MTH201','Differential Equation & Laplace Transform',2,68,'B+',3.25),

('244-0045','CSE201','Data Structure',2,91,'A+',4.00),
('244-0045','CSE202','Data Structure Lab',2,87,'A+',4.00),
('244-0045','ENG201','English 2',2,83,'A+',4.00),
('244-0045','PHY201','Physics 2',2,79,'A',3.75),
('244-0045','MTH201','Differential Equation & Laplace Transform',2,75,'A',3.75),

('244-0046','CSE201','Data Structure',2,71,'A-',3.50),
('244-0046','CSE202','Data Structure Lab',2,68,'B+',3.25),
('244-0046','ENG201','English 2',2,64,'B',3.00),
('244-0046','PHY201','Physics 2',2,60,'B',3.00),
('244-0046','MTH201','Differential Equation & Laplace Transform',2,57,'B-',2.75),

('244-0047','CSE201','Data Structure',2,86,'A+',4.00),
('244-0047','CSE202','Data Structure Lab',2,82,'A+',4.00),
('244-0047','ENG201','English 2',2,78,'A',3.75),
('244-0047','PHY201','Physics 2',2,74,'A-',3.50),
('244-0047','MTH201','Differential Equation & Laplace Transform',2,70,'A-',3.50),

('244-0048','CSE201','Data Structure',2,80,'A+',4.00),
('244-0048','CSE202','Data Structure Lab',2,76,'A',3.75),
('244-0048','ENG201','English 2',2,72,'A-',3.50),
('244-0048','PHY201','Physics 2',2,69,'B+',3.25),
('244-0048','MTH201','Differential Equation & Laplace Transform',2,65,'B+',3.25),

('244-0049','CSE201','Data Structure',2,93,'A+',4.00),
('244-0049','CSE202','Data Structure Lab',2,89,'A+',4.00),
('244-0049','ENG201','English 2',2,85,'A+',4.00),
('244-0049','PHY201','Physics 2',2,80,'A+',4.00),
('244-0049','MTH201','Differential Equation & Laplace Transform',2,76,'A',3.75),

('244-0050','CSE201','Data Structure',2,76,'A',3.75),
('244-0050','CSE202','Data Structure Lab',2,73,'A-',3.50),
('244-0050','ENG201','English 2',2,69,'B+',3.25),
('244-0050','PHY201','Physics 2',2,65,'B+',3.25),
('244-0050','MTH201','Differential Equation & Laplace Transform',2,61,'B',3.00);



INSERT INTO result
(student_id, course_code, course_name, semester_id, marks, grade, grade_point)
VALUES

('245-0001','CSE101','Structured Programming',1,87,'A+',4.00),
('245-0001','CSE102','Structured Programming Lab',1,83,'A+',4.00),
('245-0001','ENG101','English 1',1,79,'A',3.75),
('245-0001','PHY101','Physics 1',1,75,'A',3.75),
('245-0001','MTH101','Differential & Integral Calculus',1,71,'A-',3.50),

('245-0002','CSE101','Structured Programming',1,76,'A',3.75),
('245-0002','CSE102','Structured Programming Lab',1,73,'A-',3.50),
('245-0002','ENG101','English 1',1,69,'B+',3.25),
('245-0002','PHY101','Physics 1',1,65,'B+',3.25),
('245-0002','MTH101','Differential & Integral Calculus',1,61,'B',3.00),

('245-0003','CSE101','Structured Programming',1,94,'A+',4.00),
('245-0003','CSE102','Structured Programming Lab',1,90,'A+',4.00),
('245-0003','ENG101','English 1',1,85,'A+',4.00),
('245-0003','PHY101','Physics 1',1,81,'A+',4.00),
('245-0003','MTH101','Differential & Integral Calculus',1,77,'A',3.75),

('245-0004','CSE101','Structured Programming',1,81,'A+',4.00),
('245-0004','CSE102','Structured Programming Lab',1,77,'A',3.75),
('245-0004','ENG101','English 1',1,74,'A-',3.50),
('245-0004','PHY101','Physics 1',1,70,'A-',3.50),
('245-0004','MTH101','Differential & Integral Calculus',1,66,'B+',3.25),

('245-0005','CSE101','Structured Programming',1,90,'A+',4.00),
('245-0005','CSE102','Structured Programming Lab',1,86,'A+',4.00),
('245-0005','ENG101','English 1',1,82,'A+',4.00),
('245-0005','PHY101','Physics 1',1,78,'A',3.75),
('245-0005','MTH101','Differential & Integral Calculus',1,74,'A-',3.50),

('245-0006','CSE101','Structured Programming',1,70,'A-',3.50),
('245-0006','CSE102','Structured Programming Lab',1,67,'B+',3.25),
('245-0006','ENG101','English 1',1,63,'B',3.00),
('245-0006','PHY101','Physics 1',1,59,'B-',2.75),
('245-0006','MTH101','Differential & Integral Calculus',1,56,'B-',2.75),

('245-0007','CSE101','Structured Programming',1,85,'A+',4.00),
('245-0007','CSE102','Structured Programming Lab',1,81,'A+',4.00),
('245-0007','ENG101','English 1',1,77,'A',3.75),
('245-0007','PHY101','Physics 1',1,73,'A-',3.50),
('245-0007','MTH101','Differential & Integral Calculus',1,69,'B+',3.25),

('245-0008','CSE101','Structured Programming',1,79,'A',3.75),
('245-0008','CSE102','Structured Programming Lab',1,75,'A',3.75),
('245-0008','ENG101','English 1',1,71,'A-',3.50),
('245-0008','PHY101','Physics 1',1,68,'B+',3.25),
('245-0008','MTH101','Differential & Integral Calculus',1,64,'B',3.00),

('245-0009','CSE101','Structured Programming',1,92,'A+',4.00),
('245-0009','CSE102','Structured Programming Lab',1,88,'A+',4.00),
('245-0009','ENG101','English 1',1,84,'A+',4.00),
('245-0009','PHY101','Physics 1',1,79,'A',3.75),
('245-0009','MTH101','Differential & Integral Calculus',1,75,'A',3.75),

('245-0010','CSE101','Structured Programming',1,75,'A',3.75),
('245-0010','CSE102','Structured Programming Lab',1,72,'A-',3.50),
('245-0010','ENG101','English 1',1,68,'B+',3.25),
('245-0010','PHY101','Physics 1',1,64,'B',3.00),
('245-0010','MTH101','Differential & Integral Calculus',1,60,'B',3.00),

('245-0011','CSE101','Structured Programming',1,86,'A+',4.00),
('245-0011','CSE102','Structured Programming Lab',1,82,'A+',4.00),
('245-0011','ENG101','English 1',1,78,'A',3.75),
('245-0011','PHY101','Physics 1',1,74,'A-',3.50),
('245-0011','MTH101','Differential & Integral Calculus',1,70,'A-',3.50),

('245-0012','CSE101','Structured Programming',1,75,'A',3.75),
('245-0012','CSE102','Structured Programming Lab',1,72,'A-',3.50),
('245-0012','ENG101','English 1',1,68,'B+',3.25),
('245-0012','PHY101','Physics 1',1,65,'B+',3.25),
('245-0012','MTH101','Differential & Integral Calculus',1,61,'B',3.00),

('245-0013','CSE101','Structured Programming',1,93,'A+',4.00),
('245-0013','CSE102','Structured Programming Lab',1,89,'A+',4.00),
('245-0013','ENG101','English 1',1,84,'A+',4.00),
('245-0013','PHY101','Physics 1',1,80,'A+',4.00),
('245-0013','MTH101','Differential & Integral Calculus',1,76,'A',3.75),

('245-0014','CSE101','Structured Programming',1,80,'A+',4.00),
('245-0014','CSE102','Structured Programming Lab',1,76,'A',3.75),
('245-0014','ENG101','English 1',1,73,'A-',3.50),
('245-0014','PHY101','Physics 1',1,69,'B+',3.25),
('245-0014','MTH101','Differential & Integral Calculus',1,66,'B+',3.25),

('245-0015','CSE101','Structured Programming',1,89,'A+',4.00),
('245-0015','CSE102','Structured Programming Lab',1,85,'A+',4.00),
('245-0015','ENG101','English 1',1,81,'A+',4.00),
('245-0015','PHY101','Physics 1',1,77,'A',3.75),
('245-0015','MTH101','Differential & Integral Calculus',1,73,'A-',3.50),

('245-0016','CSE101','Structured Programming',1,69,'B+',3.25),
('245-0016','CSE102','Structured Programming Lab',1,66,'B+',3.25),
('245-0016','ENG101','English 1',1,62,'B',3.00),
('245-0016','PHY101','Physics 1',1,58,'B-',2.75),
('245-0016','MTH101','Differential & Integral Calculus',1,55,'B-',2.75),

('245-0017','CSE101','Structured Programming',1,84,'A+',4.00),
('245-0017','CSE102','Structured Programming Lab',1,80,'A+',4.00),
('245-0017','ENG101','English 1',1,76,'A',3.75),
('245-0017','PHY101','Physics 1',1,72,'A-',3.50),
('245-0017','MTH101','Differential & Integral Calculus',1,68,'B+',3.25),

('245-0018','CSE101','Structured Programming',1,78,'A',3.75),
('245-0018','CSE102','Structured Programming Lab',1,74,'A-',3.50),
('245-0018','ENG101','English 1',1,70,'A-',3.50),
('245-0018','PHY101','Physics 1',1,67,'B+',3.25),
('245-0018','MTH101','Differential & Integral Calculus',1,63,'B',3.00),

('245-0019','CSE101','Structured Programming',1,91,'A+',4.00),
('245-0019','CSE102','Structured Programming Lab',1,87,'A+',4.00),
('245-0019','ENG101','English 1',1,83,'A+',4.00),
('245-0019','PHY101','Physics 1',1,78,'A',3.75),
('245-0019','MTH101','Differential & Integral Calculus',1,74,'A-',3.50),

('245-0020','CSE101','Structured Programming',1,74,'A-',3.50),
('245-0020','CSE102','Structured Programming Lab',1,70,'A-',3.50),
('245-0020','ENG101','English 1',1,67,'B+',3.25),
('245-0020','PHY101','Physics 1',1,63,'B',3.00),
('245-0020','MTH101','Differential & Integral Calculus',1,59,'B-',2.75),

('245-0021','CSE101','Structured Programming',1,87,'A+',4.00),
('245-0021','CSE102','Structured Programming Lab',1,83,'A+',4.00),
('245-0021','ENG101','English 1',1,79,'A',3.75),
('245-0021','PHY101','Physics 1',1,75,'A',3.75),
('245-0021','MTH101','Differential & Integral Calculus',1,71,'A-',3.50),

('245-0022','CSE101','Structured Programming',1,76,'A',3.75),
('245-0022','CSE102','Structured Programming Lab',1,73,'A-',3.50),
('245-0022','ENG101','English 1',1,69,'B+',3.25),
('245-0022','PHY101','Physics 1',1,65,'B+',3.25),
('245-0022','MTH101','Differential & Integral Calculus',1,61,'B',3.00),

('245-0023','CSE101','Structured Programming',1,94,'A+',4.00),
('245-0023','CSE102','Structured Programming Lab',1,90,'A+',4.00),
('245-0023','ENG101','English 1',1,85,'A+',4.00),
('245-0023','PHY101','Physics 1',1,81,'A+',4.00),
('245-0023','MTH101','Differential & Integral Calculus',1,77,'A',3.75),

('245-0024','CSE101','Structured Programming',1,81,'A+',4.00),
('245-0024','CSE102','Structured Programming Lab',1,77,'A',3.75),
('245-0024','ENG101','English 1',1,74,'A-',3.50),
('245-0024','PHY101','Physics 1',1,70,'A-',3.50),
('245-0024','MTH101','Differential & Integral Calculus',1,66,'B+',3.25),

('245-0025','CSE101','Structured Programming',1,90,'A+',4.00),
('245-0025','CSE102','Structured Programming Lab',1,86,'A+',4.00),
('245-0025','ENG101','English 1',1,82,'A+',4.00),
('245-0025','PHY101','Physics 1',1,78,'A',3.75),
('245-0025','MTH101','Differential & Integral Calculus',1,74,'A-',3.50),

('245-0026','CSE101','Structured Programming',1,70,'A-',3.50),
('245-0026','CSE102','Structured Programming Lab',1,67,'B+',3.25),
('245-0026','ENG101','English 1',1,63,'B',3.00),
('245-0026','PHY101','Physics 1',1,59,'B-',2.75),
('245-0026','MTH101','Differential & Integral Calculus',1,56,'B-',2.75),

('245-0027','CSE101','Structured Programming',1,85,'A+',4.00),
('245-0027','CSE102','Structured Programming Lab',1,81,'A+',4.00),
('245-0027','ENG101','English 1',1,77,'A',3.75),
('245-0027','PHY101','Physics 1',1,73,'A-',3.50),
('245-0027','MTH101','Differential & Integral Calculus',1,69,'B+',3.25),

('245-0028','CSE101','Structured Programming',1,79,'A',3.75),
('245-0028','CSE102','Structured Programming Lab',1,75,'A',3.75),
('245-0028','ENG101','English 1',1,71,'A-',3.50),
('245-0028','PHY101','Physics 1',1,68,'B+',3.25),
('245-0028','MTH101','Differential & Integral Calculus',1,64,'B',3.00),

('245-0029','CSE101','Structured Programming',1,92,'A+',4.00),
('245-0029','CSE102','Structured Programming Lab',1,88,'A+',4.00),
('245-0029','ENG101','English 1',1,84,'A+',4.00),
('245-0029','PHY101','Physics 1',1,79,'A',3.75),
('245-0029','MTH101','Differential & Integral Calculus',1,75,'A',3.75),

('245-0030','CSE101','Structured Programming',1,75,'A',3.75),
('245-0030','CSE102','Structured Programming Lab',1,72,'A-',3.50),
('245-0030','ENG101','English 1',1,68,'B+',3.25),
('245-0030','PHY101','Physics 1',1,64,'B',3.00),
('245-0030','MTH101','Differential & Integral Calculus',1,60,'B',3.00),

('245-0031','CSE101','Structured Programming',1,88,'A+',4.00),
('245-0031','CSE102','Structured Programming Lab',1,84,'A+',4.00),
('245-0031','ENG101','English 1',1,80,'A+',4.00),
('245-0031','PHY101','Physics 1',1,76,'A',3.75),
('245-0031','MTH101','Differential & Integral Calculus',1,72,'A-',3.50),

('245-0032','CSE101','Structured Programming',1,77,'A',3.75),
('245-0032','CSE102','Structured Programming Lab',1,74,'A-',3.50),
('245-0032','ENG101','English 1',1,70,'A-',3.50),
('245-0032','PHY101','Physics 1',1,67,'B+',3.25),
('245-0032','MTH101','Differential & Integral Calculus',1,63,'B',3.00),

('245-0033','CSE101','Structured Programming',1,95,'A+',4.00),
('245-0033','CSE102','Structured Programming Lab',1,91,'A+',4.00),
('245-0033','ENG101','English 1',1,86,'A+',4.00),
('245-0033','PHY101','Physics 1',1,82,'A+',4.00),
('245-0033','MTH101','Differential & Integral Calculus',1,78,'A',3.75),

('245-0034','CSE101','Structured Programming',1,82,'A+',4.00),
('245-0034','CSE102','Structured Programming Lab',1,78,'A',3.75),
('245-0034','ENG101','English 1',1,75,'A',3.75),
('245-0034','PHY101','Physics 1',1,71,'A-',3.50),
('245-0034','MTH101','Differential & Integral Calculus',1,68,'B+',3.25),

('245-0035','CSE101','Structured Programming',1,91,'A+',4.00),
('245-0035','CSE102','Structured Programming Lab',1,87,'A+',4.00),
('245-0035','ENG101','English 1',1,83,'A+',4.00),
('245-0035','PHY101','Physics 1',1,79,'A',3.75),
('245-0035','MTH101','Differential & Integral Calculus',1,75,'A',3.75),

('245-0036','CSE101','Structured Programming',1,71,'A-',3.50),
('245-0036','CSE102','Structured Programming Lab',1,68,'B+',3.25),
('245-0036','ENG101','English 1',1,64,'B',3.00),
('245-0036','PHY101','Physics 1',1,60,'B',3.00),
('245-0036','MTH101','Differential & Integral Calculus',1,57,'B-',2.75),

('245-0037','CSE101','Structured Programming',1,86,'A+',4.00),
('245-0037','CSE102','Structured Programming Lab',1,82,'A+',4.00),
('245-0037','ENG101','English 1',1,78,'A',3.75),
('245-0037','PHY101','Physics 1',1,74,'A-',3.50),
('245-0037','MTH101','Differential & Integral Calculus',1,70,'A-',3.50),

('245-0038','CSE101','Structured Programming',1,80,'A+',4.00),
('245-0038','CSE102','Structured Programming Lab',1,76,'A',3.75),
('245-0038','ENG101','English 1',1,72,'A-',3.50),
('245-0038','PHY101','Physics 1',1,69,'B+',3.25),
('245-0038','MTH101','Differential & Integral Calculus',1,65,'B+',3.25),

('245-0039','CSE101','Structured Programming',1,93,'A+',4.00),
('245-0039','CSE102','Structured Programming Lab',1,89,'A+',4.00),
('245-0039','ENG101','English 1',1,85,'A+',4.00),
('245-0039','PHY101','Physics 1',1,80,'A+',4.00),
('245-0039','MTH101','Differential & Integral Calculus',1,76,'A',3.75),

('245-0040','CSE101','Structured Programming',1,76,'A',3.75),
('245-0040','CSE102','Structured Programming Lab',1,72,'A-',3.50),
('245-0040','ENG101','English 1',1,69,'B+',3.25),
('245-0040','PHY101','Physics 1',1,65,'B+',3.25),
('245-0040','MTH101','Differential & Integral Calculus',1,61,'B',3.00),

('245-0041','CSE101','Structured Programming',1,89,'A+',4.00),
('245-0041','CSE102','Structured Programming Lab',1,85,'A+',4.00),
('245-0041','ENG101','English 1',1,81,'A+',4.00),
('245-0041','PHY101','Physics 1',1,77,'A',3.75),
('245-0041','MTH101','Differential & Integral Calculus',1,73,'A-',3.50),

('245-0042','CSE101','Structured Programming',1,78,'A',3.75),
('245-0042','CSE102','Structured Programming Lab',1,75,'A',3.75),
('245-0042','ENG101','English 1',1,71,'A-',3.50),
('245-0042','PHY101','Physics 1',1,68,'B+',3.25),
('245-0042','MTH101','Differential & Integral Calculus',1,64,'B',3.00),

('245-0043','CSE101','Structured Programming',1,96,'A+',4.00),
('245-0043','CSE102','Structured Programming Lab',1,92,'A+',4.00),
('245-0043','ENG101','English 1',1,88,'A+',4.00),
('245-0043','PHY101','Physics 1',1,83,'A+',4.00),
('245-0043','MTH101','Differential & Integral Calculus',1,79,'A',3.75),

('245-0044','CSE101','Structured Programming',1,83,'A+',4.00),
('245-0044','CSE102','Structured Programming Lab',1,79,'A',3.75),
('245-0044','ENG101','English 1',1,76,'A',3.75),
('245-0044','PHY101','Physics 1',1,72,'A-',3.50),
('245-0044','MTH101','Differential & Integral Calculus',1,69,'B+',3.25),

('245-0045','CSE101','Structured Programming',1,92,'A+',4.00),
('245-0045','CSE102','Structured Programming Lab',1,88,'A+',4.00),
('245-0045','ENG101','English 1',1,84,'A+',4.00),
('245-0045','PHY101','Physics 1',1,80,'A+',4.00),
('245-0045','MTH101','Differential & Integral Calculus',1,76,'A',3.75),

('245-0046','CSE101','Structured Programming',1,72,'A-',3.50),
('245-0046','CSE102','Structured Programming Lab',1,69,'B+',3.25),
('245-0046','ENG101','English 1',1,65,'B+',3.25),
('245-0046','PHY101','Physics 1',1,61,'B',3.00),
('245-0046','MTH101','Differential & Integral Calculus',1,58,'B-',2.75),

('245-0047','CSE101','Structured Programming',1,87,'A+',4.00),
('245-0047','CSE102','Structured Programming Lab',1,83,'A+',4.00),
('245-0047','ENG101','English 1',1,79,'A',3.75),
('245-0047','PHY101','Physics 1',1,75,'A',3.75),
('245-0047','MTH101','Differential & Integral Calculus',1,71,'A-',3.50),

('245-0048','CSE101','Structured Programming',1,81,'A+',4.00),
('245-0048','CSE102','Structured Programming Lab',1,77,'A',3.75),
('245-0048','ENG101','English 1',1,73,'A-',3.50),
('245-0048','PHY101','Physics 1',1,70,'A-',3.50),
('245-0048','MTH101','Differential & Integral Calculus',1,66,'B+',3.25),

('245-0049','CSE101','Structured Programming',1,94,'A+',4.00),
('245-0049','CSE102','Structured Programming Lab',1,90,'A+',4.00),
('245-0049','ENG101','English 1',1,86,'A+',4.00),
('245-0049','PHY101','Physics 1',1,81,'A+',4.00),
('245-0049','MTH101','Differential & Integral Calculus',1,77,'A',3.75),

('245-0050','CSE101','Structured Programming',1,77,'A',3.75),
('245-0050','CSE102','Structured Programming Lab',1,73,'A-',3.50),
('245-0050','ENG101','English 1',1,70,'A-',3.50),
('245-0050','PHY101','Physics 1',1,66,'B+',3.25),
('245-0050','MTH101','Differential & Integral Calculus',1,62,'B',3.00);

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO admin (username, password)
VALUES ('admin', 'admin123');