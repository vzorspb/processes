USE [processes]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [authority](
 [id] [int] IDENTITY(1,1) NOT NULL,
[number] [nchar](10) NULL,
 [text] [text] NULL,
[order] [int] NULL,
 [org_id] [int] NULL,
 CONSTRAINT [PK_authority] PRIMARY KEY CLUSTERED 
 (
 [id] ASC
 )WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
 ) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
 GO
 SET ANSI_NULLS ON
 GO
 SET QUOTED_IDENTIFIER ON
 GO
 CREATE TABLE [authority_add](
 [id] [int] IDENTITY(1,1) NOT NULL,
 [process_id] [int] NULL,
 [authority_id] [int] NULL
 ) ON [PRIMARY]
 GO
 SET ANSI_NULLS ON
 GO
 SET QUOTED_IDENTIFIER ON
 GO
 CREATE TABLE [desc_prority](
 [id] [int] IDENTITY(1,1) NOT NULL,
 [level] [nchar](10) NULL,
 [descr] [nchar](128) NULL
 ) ON [PRIMARY]
 GO
 SET ANSI_NULLS ON
 GO
 SET QUOTED_IDENTIFIER ON
 GO
 CREATE TABLE [descr_level](
 [id] [int] IDENTITY(1,1) NOT NULL,
 [level] [nchar](10) NULL,
 [descr] [nchar](200) NULL,
 CONSTRAINT [PK_descr_level] PRIMARY KEY CLUSTERED 
 (
 [id] ASC
 )WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
 ) ON [PRIMARY]
 GO
 SET ANSI_NULLS ON
 GO
 SET QUOTED_IDENTIFIER ON
 GO
 CREATE TABLE [exec_level](
 [id] [int] IDENTITY(1,1) NOT NULL,
 [level] [nchar](10) NULL,
 [descr] [nchar](128) NULL,
 CONSTRAINT [PK_exec_level] PRIMARY KEY CLUSTERED 
 (
 [id] ASC
 )WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
 ) ON [PRIMARY]
 GO
 SET ANSI_NULLS ON
 GO
 SET QUOTED_IDENTIFIER ON
 GO
 CREATE TABLE [it_system](
 [id] [int] IDENTITY(1,1) NOT NULL,
 [name] [nchar](200) NULL,
 [s_name] [nchar](20) NULL,
 CONSTRAINT [PK_it_system] PRIMARY KEY CLUSTERED 
 (
 [id] ASC
 )WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
 ) ON [PRIMARY]
 GO
 SET ANSI_NULLS ON
 GO
 SET QUOTED_IDENTIFIER ON
 GO
 CREATE TABLE [logs](
 [id] [int] IDENTITY(1,1) NOT NULL,
 [ip] [nchar](16) NULL,
 [post] [text] NULL,
 [login] [nchar](32) NULL,
 CONSTRAINT [PK_logs] PRIMARY KEY CLUSTERED 
 (
 [id] ASC
 )WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
 ) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
 GO
 SET ANSI_NULLS ON
 GO
 SET QUOTED_IDENTIFIER ON
 GO
 CREATE TABLE [measurement](
 [id] [int] IDENTITY(1,1) NOT NULL,
 [measurement_name] [nchar](10) NULL,
 [multiplexer] [int] NULL,
 CONSTRAINT [PK_measurement] PRIMARY KEY CLUSTERED 
 (
 [id] ASC
 )WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
 ) ON [PRIMARY]
 GO
 SET ANSI_NULLS ON
 GO
 SET QUOTED_IDENTIFIER ON
 GO
 CREATE TABLE [npa](
 [id] [int] IDENTITY(1,1) NOT NULL,
 [text] [text] NULL,
 CONSTRAINT [PK_npa] PRIMARY KEY CLUSTERED 
 (
 [id] ASC
 )WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
 ) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
 GO
 SET ANSI_NULLS ON
 GO
 SET QUOTED_IDENTIFIER ON
 GO
 CREATE TABLE [org_structure](
 [id] [int] IDENTITY(1,1) NOT NULL,
 [unit_name] [text] NULL,
 [parrent_id] [int] NULL,
 [note] [nvarchar](100) NULL,
 [type] [nchar](10) NULL,
 [sort_level] [int] NULL,
 [org_id] [int] NULL,
 [ip] [nchar](15) NULL,
 [login] [nchar](32) NULL,
 [password] [nchar](32) NULL,
 [session] [nchar](40) NULL,
 CONSTRAINT [PK_org_structure_1] PRIMARY KEY CLUSTERED 
 (
 [id] ASC
 )WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
 ) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
 GO
 SET ANSI_NULLS ON
 GO
 SET QUOTED_IDENTIFIER ON
 GO
 CREATE TABLE [process_it_system](
 [id] [int] IDENTITY(1,1) NOT NULL,
 [process_id] [int] NULL,
 [it_system_id] [int] NULL,
 CONSTRAINT [PK_process_it_system] PRIMARY KEY CLUSTERED 
 (
 [id] ASC
 )WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
 ) ON [PRIMARY]
 GO
 SET ANSI_NULLS ON
 GO
 SET QUOTED_IDENTIFIER ON
 GO
 CREATE TABLE [process_workers](
 [id] [int] IDENTITY(1,1) NOT NULL,
 [process_id] [int] NULL,
 [worker_id] [int] NULL,
 CONSTRAINT [PK_process_workers_1] PRIMARY KEY CLUSTERED 
 (
 [id] ASC
 )WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
 ) ON [PRIMARY]
 GO
 SET ANSI_NULLS ON
 GO
 SET QUOTED_IDENTIFIER ON
 GO
 CREATE TABLE [processes](
 [id] [int] IDENTITY(1,1) NOT NULL,
 [name] [text] NULL,
 [authority_id] [int] NULL,
 [owner_id] [int] NULL,
 [parrent_process_id] [int] NULL,
 [npa] [text] NULL,
 [desc_priority] [int] NULL,
 [desc_level] [int] NULL,
 [exec_level] [int] NULL,
 [p_start] [text] NULL,
 [sender_id] [int] NULL,
 [p_finish] [text] NULL,
 [reciever_id] [int] NULL,
 [problems] [text] NULL,
 [measurement_id] [int] NULL,
 [vpp] [int] NULL,
 CONSTRAINT [PK_processes_1] PRIMARY KEY CLUSTERED 
 (
 [id] ASC
 )WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
 ) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
USE [processes]
GO
SET IDENTITY_INSERT [desc_prority] ON 

INSERT [desc_prority] ([id], [level], [descr]) VALUES (7, '1 очередь ', 'отсутствие описания процесса наносит ущерб деятельности ИОГВ. Ущерб наносится постоянно. ')
INSERT [desc_prority] ([id], [level], [descr]) VALUES (8, '2 очередь ', 'отсутствие описания процесса наносит ущерб деятельности ИОГВ. Ущерб наносится периодически ')
INSERT [desc_prority] ([id], [level], [descr]) VALUES (9, '3 очередь ', 'отсутствие описания процесса имеет риск нанесения ущерба деятельности ИОГВ. Ущерб пока не наносится. ')
INSERT [desc_prority] ([id], [level], [descr]) VALUES (10, '4 очередь ', 'риск нанесения ущерба деятельности ИОГВ из-за отсутствия описания процесса незначителен ')
INSERT [desc_prority] ([id], [level], [descr]) VALUES (12, '- ', 'Процесс вынесен для рассотрения на заседании рабочей группы Комитета ')
SET IDENTITY_INSERT [desc_prority] OFF
GO
SET IDENTITY_INSERT [descr_level] ON 

INSERT [descr_level] ([id], [level], [descr]) VALUES (1, '1 ', 'описание полностью отсутствует ')
INSERT [descr_level] ([id], [level], [descr]) VALUES (2, '2 ', 'процесс описан частично разными слабо связанными друг с другом документами (инструкции, приказы, распоряжения и т.п.). Эти документы требуют актуализации. ')
INSERT [descr_level] ([id], [level], [descr]) VALUES (3, '3 ', 'процесс описан частично разными слабо связанными друг с другом документами (инструкции, приказы, распоряжения и т.п.). Эти документы актуальны. ')
INSERT [descr_level] ([id], [level], [descr]) VALUES (4, '4 ', 'процесс описан в рамках отдельного документа (стандарт, регламент, порядок, положение). Этот документ требует актуализации. ')
INSERT [descr_level] ([id], [level], [descr]) VALUES (5, '5 ', 'процесс описан в рамках отдельного (стандарт, регламент, порядок, положение). Этот документ актуален. ')
SET IDENTITY_INSERT [descr_level] OFF
GO
SET IDENTITY_INSERT [exec_level] ON 

INSERT [exec_level] ([id], [level], [descr]) VALUES (1, '1 ', 'процесс не исполняется никогда. ')
INSERT [exec_level] ([id], [level], [descr]) VALUES (2, '2 ', 'процесс исполняется от случая к случаю. Результаты процесса не стабильны по качеству и количеству. ')
INSERT [exec_level] ([id], [level], [descr]) VALUES (3, '3 ', 'процесс исполняется от случая к случаю. Результаты процесса стабильны по качеству и количеству. ')
INSERT [exec_level] ([id], [level], [descr]) VALUES (4, '4 ', 'процесс исполняется постоянно. Результаты процесса не стабильны по качеству и количеству. ')
INSERT [exec_level] ([id], [level], [descr]) VALUES (5, '5 ', 'процесс исполняется постоянно. Результаты процесса стабильны по качеству и количеству. ')
SET IDENTITY_INSERT [exec_level] OFF
GO
SET IDENTITY_INSERT [measurement] ON 

INSERT [measurement] ([id], [measurement_name], [multiplexer]) VALUES (1, 'минута ', 1)
INSERT [measurement] ([id], [measurement_name], [multiplexer]) VALUES (2, 'час ', 60)
INSERT [measurement] ([id], [measurement_name], [multiplexer]) VALUES (3, 'раб. день ', 480)
INSERT [measurement] ([id], [measurement_name], [multiplexer]) VALUES (4, 'кал. день ', 480)
INSERT [measurement] ([id], [measurement_name], [multiplexer]) VALUES (5, 'месяц ', 86400)
SET IDENTITY_INSERT [measurement] OFF
GO
