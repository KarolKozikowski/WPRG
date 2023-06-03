-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2023-06-03 15:29:24.406

-- tables
-- Table: Aircraft
CREATE TABLE Aircraft (
    ID int  NOT NULL,
    Airframe_type_id int  NOT NULL,
    REG char(6)  NOT NULL,
    HasTwoClass_config bool  NOT NULL,
    CONSTRAINT Aircraft_pk PRIMARY KEY (ID)
);

-- Table: Airframe_type
CREATE TABLE Airframe_type (
    ID int  NOT NULL,
    Make varchar(50)  NOT NULL,
    Model varchar(20)  NOT NULL,
    ICAO_reg char(4)  NOT NULL,
    OperCost_hour float(4,2)  NOT NULL,
    OneClassConfig_capacity int  NOT NULL,
    TwoClassConfig_capacity int  NOT NULL,
    CONSTRAINT Airframe_type_pk PRIMARY KEY (ID)
);

-- Table: Airports
CREATE TABLE Airports (
    ID int  NOT NULL,
    ICAO char(4)  NOT NULL,
    IATA char(3)  NOT NULL,
    Municipality varchar(128)  NOT NULL,
    Name varchar(128)  NOT NULL,
    CONSTRAINT Airports_pk PRIMARY KEY (ID)
);

-- Table: Flights
CREATE TABLE Flights (
    ID int  NOT NULL,
    Route_id int  NOT NULL,
    Dep_date date  NOT NULL,
    Dep_time time  NOT NULL,
    Aircraft_id int  NOT NULL,
    CONSTRAINT Flights_pk PRIMARY KEY (ID)
);

-- Table: Routes
CREATE TABLE Routes (
    ID int  NOT NULL,
    Flight_nr int  NOT NULL,
    Enroute_time int  NOT NULL,
    Departure_id int  NOT NULL,
    Arrival_id int  NOT NULL,
    CONSTRAINT Routes_pk PRIMARY KEY (ID)
);

-- Table: Tickets
CREATE TABLE Tickets (
    ID int  NOT NULL,
    Users_id int  NOT NULL,
    Flight_id int  NOT NULL,
    Seat char(3)  NOT NULL,
    Gate int  NULL,
    Hand_Luggage bool  NOT NULL,
    Check_In_Luggage bool  NOT NULL,
    Traveling_With_Kids bool  NOT NULL,
    CONSTRAINT Tickets_pk PRIMARY KEY (ID)
);

-- Table: Users
CREATE TABLE Users (
    ID int  NOT NULL,
    First_name varchar(128)  NOT NULL,
    Last_name varchar(128)  NOT NULL,
    Phone_nr char(11)  NOT NULL,
    Email varchar(128)  NOT NULL,
    Country varchar(128)  NOT NULL,
    Is_Fat bool  NOT NULL,
    CONSTRAINT Users_pk PRIMARY KEY (ID)
);

-- foreign keys
-- Reference: Aircraft_Aircraft_type (table: Aircraft)
ALTER TABLE Aircraft ADD CONSTRAINT Aircraft_Aircraft_type FOREIGN KEY Aircraft_Aircraft_type (Airframe_type_id)
    REFERENCES Airframe_type (ID);

-- Reference: Airports_Routes (table: Routes)
ALTER TABLE Routes ADD CONSTRAINT Airports_Routes FOREIGN KEY Airports_Routes (Departure_id)
    REFERENCES Airports (ID);

-- Reference: Flights_Aircraft (table: Flights)
ALTER TABLE Flights ADD CONSTRAINT Flights_Aircraft FOREIGN KEY Flights_Aircraft (Aircraft_id)
    REFERENCES Aircraft (ID);

-- Reference: Flights_Routes (table: Flights)
ALTER TABLE Flights ADD CONSTRAINT Flights_Routes FOREIGN KEY Flights_Routes (Route_id)
    REFERENCES Routes (ID);

-- Reference: Routes_Airports (table: Routes)
ALTER TABLE Routes ADD CONSTRAINT Routes_Airports FOREIGN KEY Routes_Airports (Arrival_id)
    REFERENCES Airports (ID);

-- Reference: Tickets_Flights (table: Tickets)
ALTER TABLE Tickets ADD CONSTRAINT Tickets_Flights FOREIGN KEY Tickets_Flights (Flight_id)
    REFERENCES Flights (ID);

-- Reference: Tickets_Users (table: Tickets)
ALTER TABLE Tickets ADD CONSTRAINT Tickets_Users FOREIGN KEY Tickets_Users (Users_id)
    REFERENCES Users (ID);

-- End of file.

