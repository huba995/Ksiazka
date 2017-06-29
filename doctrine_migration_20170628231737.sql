-- Doctrine Migration File Generated on 2017-06-28 23:17:37

-- Version 20170628204126
CREATE TABLE addresses (id INT NOT NULL, street VARCHAR(255) NOT NULL, PRIMARY KEY(id)) ENGINE = InnoDB;
INSERT INTO migration_versions (version) VALUES ('20170628204126');
