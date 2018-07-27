# countboard-api
CountBoard APIs (Tag and Asset Management)


These PHPs are necessary to CRUD to the SQL Server.


#Database
Below are the scripts to generate the DB.

create schema countboard;




/****** Object:  Table [countboard].[tags]    Script Date: 2018-07-27 6:54:01 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [countboard].[tags](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[uuid] [nvarchar](50) NOT NULL,
	[rfid] [nvarchar](50) NULL,
	[usb] [nvarchar](50) NULL,
	[tagtype] [nvarchar](50) NOT NULL,
	[oid] [nvarchar](50) NULL,
	[fps] [nvarchar](50) NULL,
	[bedid] [nvarchar](50) NULL,
	[facility] [nvarchar](50) NULL,
	[location] [nvarchar](50) NULL,
	[longitude] [float] NULL,
	[latitude] [float] NULL,
	[description_en] [nvarchar](100) NULL,
	[description_fr] [nvarchar](100) NULL,
	[createddate] [datetime2](7) NOT NULL,
	[deactivateddate] [datetime2](7) NULL,
	[active] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO



/****** Object:  Table [countboard].[taps]    Script Date: 2018-07-27 6:55:20 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [countboard].[taps](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[uuid] [nvarchar](50) NOT NULL,
	[device] [nvarchar](50) NULL,
	[facility] [nvarchar](50) NULL,
	[location] [nvarchar](50) NULL,
	[locationuuid] [nvarchar](50) NULL,
	[rfid] [nvarchar](50) NULL,
	[usb] [nvarchar](50) NULL,
	[inout] [int] NULL,
	[time] [bigint] NULL,
	[createddate] [datetime2](7) NULL,
	[deactivateddate] [datetime2](7) NULL,
	[active] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO



